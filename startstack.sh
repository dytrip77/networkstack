#!/bin/sh
python parse_csv.py #require ip.csv. will generate hosts.list
python stack.py hosts.list commands.list #require hosts.list and commands.list. will generate output in .text format.
./trim.sh #remove first match(master switch). will generate .txt file.
./clean.sh > stack.csv #process txt file to csv format
mysql -u root -proot -h dbhost dbtable < mysqlstack.txt #insert data to mysql table. Require data in csv format.
php xml-generate.php #generate xml file from db server. xml files will be created
fusioninventory-injector -v -R -d ~/ --url http://glpiipaddress/glpi/plugins/fusioninventory #send xml data to glpi
rm -rf *.text *.txt #remove generated text file