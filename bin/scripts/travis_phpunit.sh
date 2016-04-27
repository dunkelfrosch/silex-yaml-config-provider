#!/bin/bash
#
# travis call for phpunit check
#

cd ../..

phpunit --testdox

if [ $? -eq 0 ]
then
  echo "\nPHPUnit run succeeded."
else
  echo "\noPHPUnit run failed!" >&2
fi

cd bin/scripts