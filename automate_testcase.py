#!/usr/bin/python3

class bcolors:
  HEADER = '\033[95m'
  OKBLUE = '\033[94m'
  OKGREEN = '\033[92m'
  WARNING = '\033[93m'
  FAIL = '\033[91m'
  ENDC = '\033[0m'
  BOLD = '\033[1m'
  UNDERLINE = '\033[4m'

try:
  import sys
  import subprocess
  import json
except ModuleNotFoundError as error:
  print(f'Please Install : {error.name}')

def run(command_list, name):
  print(f'==============================================')
  with open(name+".json") as outfile:
    testcase = json.load(outfile)
  case_no = 1
  for given_input, expected_output in testcase.items():
    if not len(command_list) > 4 :
      run = subprocess.Popen(command_list, stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    else:
      complie = subprocess.Popen(command_list[:-1])
      run = subprocess.Popen(command_list[-1], stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    run.stdin.write(str.encode(given_input))
    actual_output, probable_cause = run.communicate()
    print(f'Test No: {case_no}                        ', end='')
    if actual_output.decode("utf-8") == expected_output:
      print(f'{bcolors.OKGREEN}PASSED{bcolors.ENDC}')
    else:
#!/usr/bin/python3

class bcolors:
  HEADER = '\033[95m'
  OKBLUE = '\033[94m'
  OKGREEN = '\033[92m'
  WARNING = '\033[93m'
  FAIL = '\033[91m'
  ENDC = '\033[0m'
  BOLD = '\033[1m'
  UNDERLINE = '\033[4m'

try:
  import sys
  import subprocess
  import json
except ModuleNotFoundError as error:
  print(f'Please Install : {error.name}')

def run(command_list, name):
  print(f'==============================================')
  with open(name+".json") as outfile:
    testcase = json.load(outfile)
  case_no = 1
  for given_input, expected_output in testcase.items():
    if not len(command_list) > 4 :
      run = subprocess.Popen(command_list, stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    else:
      complie = subprocess.Popen(command_list[:-1])
      run = subprocess.Popen(command_list[-1], stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    run.stdin.write(str.encode(given_input))
    actual_output, probable_cause = run.communicate()
    print(f'Test No: {case_no}                        ', end='')
    if actual_output.decode("utf-8") == expected_output:
      print(f'{bcolors.OKGREEN}PASSED{bcolors.ENDC}')
    else:
      print(f'{bcolors.FAIL}FAILED{bcolors.ENDC}')
      print(f'{bcolors.FAIL}Failed Case {case_no} Details:{bcolors.ENDC}')
      print(f'Input:\n{given_input}', end='\r')
      print(f'Expected Output:\n{expected_output}',end='\r')
      print(f'Actual Output:\n{actual_output.decode("utf-8")}', end='\r')
      print(f'Probable Error:\n{probable_cause.decode("utf-8")}')
    case_no += 1

# Showing Diff between actual and expected resul
# Check Memomry Limit and Time Limit and
# Show Used Memory and Time
# Possible Windows implementation
if len(sys.argv) == 2 :      # Not File to Run as
    file_name = sys.argv[1]
    name_extension = file_name.split('.')
    name = name_extension[0]
    extension =  name_extension[1]
    print(file_name)
    if extension=='py':
      run(['python3', file_name], name)
    elif extension=='cpp':
      run(['g++', file_name, '-o', name+'.out', './'+name+'.out'], name)
    elif extension=='c':
      run(['gcc',file_name], name)
    else:
      print("This programming Language is not supported yet")
else:
    sys.stderr.write(f'Useage: cmp <file name>')
    sys.stderr.write(f'Supported Language:\n#Python3\n#C\n#C++')
