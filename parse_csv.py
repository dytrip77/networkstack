#!/usr/bin/python
# -*- coding: utf-8 -*-
import csv
import sys
sys.stdout = open('output', 'w')

with open('input', 'r') as csv_file:
    csv_reader = csv.reader(csv_file)

    next(csv_reader)

    for line in csv_reader:
        print line[2]

sys.stdout.close()
