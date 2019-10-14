#!/bin/python3
import time

loop = 100
bar = '#'
space = ' '
for j in range(loop):
  i = j+1
  print(f'{bar*i}{space*(loop-i)}| {i}% ', end='')
  time.sleep(.1)
  print('\r', end='')
