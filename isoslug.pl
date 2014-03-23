#!/usr/bin/perl -w


open(FILE, "kort.php") or die;
@lines = <FILE>;
close(FILE);

$file = join('', @lines);

while ($file =~ m/alt=\"(.+)?\" data-tag=\"(.+)?\" data-iso=\"(.+)?\"/ig) {
    ($s1, $s2) = split(/"/, $3);
    
    print "'$s1': { ice_name:'$1', tag:'$2' },\n";
    
    
}

#alt="Bangladess" data-tag="bangladesh" data-iso="BD" 


