#!/usr/bin/python3.8

from requests import get
from bs4 import BeautifulSoup
import re

html_data = get('https://www.imdb.com/chart/top').text
soup = BeautifulSoup(html_data, 'html.parser')

title_columns = soup.find_all(attrs={'class':"titleColumn"})

pattern = r'(\d{1,3}\.)\s*([^\n]*)\n(\(\d{4}\))'
movies = [re.findall(pattern, title.text)[0] for title in title_columns] 
movies = [ ' '.join(movie) for movie in movies ]

with open('imdb_250_list.txt', 'w') as t:
    for movie in movies:
        t.write(f'{movie}\n')
