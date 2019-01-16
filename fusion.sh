#!/usr/bin/env bash
#scan stack ip to reinventorize missing information

for f in *.txt; do
	echo "fusion scan is running";
	fusioninventory-netinventory --host ${f%.*} --credentials version:2c,community:public --threads 50 > /tmp/${f%.*}.xml;
	fusioninventory-injector -v -R -d /tmp --url http://glpiipaddress/glpi/plugins/fusioninventory;
done
