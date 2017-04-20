#!/bin/bash

rm -f plot.html
sniper -c 10 -n 1000 -s 'true' -f urls.txt
open plot.html

