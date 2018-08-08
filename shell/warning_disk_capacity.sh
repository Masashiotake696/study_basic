#!/bin/bash

capacity=`df | sed -e '1d' | grep disk1s1 | awk '{print $5;}' | sed -e 's/%//'`

if [ $capacity -gt 80 ]; then
  echo "Warning!!!"
fi
echo "Now disk capacity is" $capacity
  
