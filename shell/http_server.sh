#!/bin/bash

while read line
do
  if [ `echo $line | awk '{print $1;}'` != 'GET' ]; then
    echo "Bad HTTP status"
  fi

  file=`echo $line | awk '{print $2;}' | tr -d '/'`
  if [ -e $file ]; then
    echo `cat $file`
  else
    echo "No such file: " $file 
  fi
done
