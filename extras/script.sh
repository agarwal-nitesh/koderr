#!/bin/bash

somevar=`echo "select name 'NAME       |','   ',user 'ROLL NO.    |','     ',file 'FILE NAME   | ', '     ',time as 'TIME       |','</br>' from userinfo where file IS NOT NULL" | mysql -u root -pnightangle lamp`

echo $somevar


