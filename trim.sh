for f in *.text;
    do f2=${f%.*}.txt;
    cp $f $f2;
    echo "Processing $f2 file...";
    cat $f | tail -n +10 > $f2;
done