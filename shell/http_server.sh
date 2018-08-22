#!/bin/bash

while read line
do
  if [ `echo $line | awk '{print $1;}'` != 'GET' ]; then
    echo "Bad HTTP method"
  fi

  file=`echo $line | awk '{print $2;}' | tr -d '/'`
  if [ -r $file ]; then
    cat $file
  else
    echo "No such file: " $file 
  fi
done
