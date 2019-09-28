'''
Here the certificate is turnt off by cert variable.
If in future, it is necessary to use certificate, use this variable 
certificate can be found in https://curl.haxx.se/docs/caextract.html

'''
import requests
import re
import os
root_dir = 'PDF_Archieve'
cert = False

def downloading_step_1():
    #--- generating url ---
    url='https://www.bracu.ac.bd/final-examinations-seat-plan-'
    semesters=[ 'spring-', 'summer-', 'fall-' ]
    urls = [ ]
    year, month = y_m_time()
    # starting from 2017 the link will start to generate
    for i in range(2017,(year+1)):  
        for s in range(len(semesters)):
            # if the current semester is not bigger of the semesters[s] eg 1, 2, 3
            if (not(month>(s+1)) and i==year): 
                pass
            else:
                #generated url 
                temp_url = url+semesters[s]+str(i)
                print(temp_url)
                urls.append(temp_url)
    return urls

def downloading_step_2(urls):
    pdf_links = []
    for url in urls:
        #download the plain html file 
        file = requests.get(url, timeout=20, verify=cert)
        html = file.text
        link_pattern = re.compile(r'<a href="//(www.bracu.ac.bd/sites/default/files/registrar/exam_seat_plan/\w+-*\d+/\w{3}\d{3}.pdf)" target="_blank"')
        pdf_link = link_pattern.findall(html) 
        pdf_links.append(pdf_link)
    return pdf_links

def downloading_step_3(urls_list):
    j= 0
    os.mkdir(root_dir)    #central directory to save all the downloaded pdf
    semesters=[ 'Spring-', 'Summer-', 'Fall-' ]
    year, month = y_m_time()
    for i in range(2017,(year+1)):
        for s in range(len(semesters)):
            if (not(month>(s+1)) and i==year): 
                folder = root_dir+'/'+semesters[s]+str(i)
                os.mkdir(folder)
                print('         '+semesters[s]+str(i)+' is Created ... ')
                for url in urls_list[j]:
                    r = requests.get('http://'+url, stream=True, verify=cert)
                    file_name = url.split('/')[-1]
                    chunk_size = 2000
                    with open(folder+'/'+file_name, 'wb') as fd:
                        for chunk in r.iter_content(chunk_size):
                            fd.write(chunk)
                    fd.close()
                j=j+1
            else:
                pass


def downloading_step_4(): 
    import json
    import PyPDF2

    st_db = {'University Name': 'BRAC University', 'Range':'2019-2017', 'Student':[]}

    dir_list = os.listdir(root_dir)
    for d in dir_list:
        file_list = os.listdir(root_dir+'/'+d)
        print('         '+d+' is Processing ... ')
        for course_name in file_list:
            pdf_object = open(root_dir+'/'+d+'/'+course_name, 'rb')
            # First line is being read to check if it is a "file not found" html page
            temp = pdf_object.readline()
            temp = temp[:2] 
            files_first_line = temp.decode()
            # in html page first two character would be <! and as the file is being 
            # read as byte it is being converted to string by .decode()
            if files_first_line == '<!':
                pass
            else:
                pypdf2_object = PyPDF2.PdfFileReader(pdf_object)
                for page_no in range(0, pypdf2_object.numPages):
                    page_object = pypdf2_object.getPage(page_no)  
                    total_text = page_object.extractText()
                    r = re.compile(r'(\d{8})(\D+\s(\D*\s)*\D+)\d{2}(\d{10})')
                    info = r.findall(total_text)
    #   json format
    #   'student' : [
    #   {   'id' : 17201049
    #       'information' : {   'name' = 'Kamrul Hasan', 
    #                           'Registration No': 1234123412 ,
    #                           'course' : {
    #                           'Summer 2017' : ['CSE101', 'BIO101'], 
    #                           'Fall 2017' : ['CSE101', 'BIO101']  
    #                               }
    #               }
    #     }          ]
                    
                    for i in info:
                        st_id, name, blank, reg = i
                        db = {}
                        #if the id is not in json
                        if not(st_id in db.values()) :
                            db['id'] = int(st_id)
                            db['info'] = {}                     
                            db['info']['name'] = name.title()
                            db['info']['Registration No'] = int(reg)
                            db['info']['course'] = {}
                            db['info']['course'][d] = [course_name.split('.')[0]]
                    
                        else :
                            #id is there so, name, Registration No and atleast one course
                            #so now checking the if the current semester exist
                            if not(sem in db['info']['course'].values()): #doestn't exist
                                db['info']['course'][d] = [course_name] #add the course by creating a key
                            else : #a list for course of this current semester exist
                                db['info']['course'][d].append(course_name) #add the course by appending
                        st_db['Student'].append(db)
                pdf_object.close()
        f = open('student_info_db.txt', 'w')
        json.dump(st_db, f)
        f.close()

def y_m_time():
    # this function returns tuple of year and number of semester in that year
    # this funtion helps to determine till which semester seat plan is available
    import time
    current_date_raw = str(time.localtime())
    t = re.compile(r'time.struct_time\(tm_year=(\d{4}), tm_mon=(\d{1,2}),')
    r = t.findall(current_date_raw) # r is [('2019', '9')]
    year = int(r[0][0])
    m = int(r[0][1])
    month = 0
    if m <= 4 :
        month = 1
    elif m <= 8 and m>8 :
        month = 2
    else :
        month = 3
    return (year, month)

def main():
    
    print('____________Scrapping____________\nStep 1 : Generating HTML links')
    html_links = downloading_step_1()              #generating html links

    print('Step 2 : Finding PDF links in these HTMLs')
    pdf_links = downloading_step_2(html_links)      #generating pdf link in these htmls

    print('Step 3 : Downloading these PDFs')
    downloading_step_3(pdf_links)                   #downloading these pdf 
    print('Step:4 : Sending PDFs to read and parse student info')
    downloading_step_4()                            #sending pdf to read parse student info
    print('JSON is created ...!!')

if __name__ == "__main__":
    main()