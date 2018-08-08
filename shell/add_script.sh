#!/bin/bash

for file in `find /Users/m_ootake/Downloads/invhtml/ -name '*.html'`; do
  sed -i -e 's/<\/head>/<script>alert(‘LFタグ！’);<\/script><\/head>/' $file
done
