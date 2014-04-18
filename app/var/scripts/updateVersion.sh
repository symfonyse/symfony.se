#!/bin/bash

FILE="app/config/version.yml"

echo "#This is an auto generated file that will be updated at every deploy" > $FILE

echo "parameters:
  git_commit: '$(git rev-parse --short HEAD)'" >> $FILE

#if we want the tag we could use "git describe HEAD"
# See documentaion at http://developer.happyr.se/rename-dump-from-asseticbundle