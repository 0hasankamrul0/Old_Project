#!/bin/bash
i=1
sp="/-\|"
while true
  do
        printf "Spinning:  "
        
        # --- Only Line of Code that is important ---
        # sp: substring of sp
        # (i++)%${#sp} : position mod total length so it wraps around
        # 1 length of substring
        
        printf "${sp:i++%${#sp}:1}" 
        printf "           "
        printf "\r"
        sleep .5
  done
