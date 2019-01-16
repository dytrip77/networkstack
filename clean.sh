#!/usr/bin/env bash
 
re_descr='DESCR: "([^"]+)"'
re_sn='SN: ([^[:space:]]+)'
re_host='hostname ([^"]+)'

while IFS= read -r line; do line=${line%$'\r'}
    [[ $REPLY =~ $re_descr ]] && descr=${BASH_REMATCH[1]}
    [[ $REPLY =~ $re_sn ]]    && sn=${BASH_REMATCH[1]}
    [[ $REPLY =~ $re_host ]]  && host=${BASH_REMATCH[1]}
    if [[ $descr && $sn ]]; then
        printf '%s-%s,%s\n' "$host" "$descr" "$sn"
        descr= sn=
    fi
done < /root/*.txt
