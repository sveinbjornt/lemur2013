#!/usr/bin/perl -w

use strict;


# READ IN ENGLISH TO ISO MAP
open(CSV, "countries.csv") or die;
my @lines = <CSV>;
close(CSV);

my %en2iso;
my %iso2en;

foreach (@lines) {
    my $line = $_;
    $line =~ s/\n//;
    $line =~ s/\r//;
    my ($index, $en_name, $iso) = split(/","/, $line);
    $iso =~ s/"//g;
    
    $en2iso{$en_name} = $iso;
    $iso2en{$iso} = $en_name;
    
    # print "$en_name --> $iso\n";
}

# READ IN ISO CODE TO ICELANDIC MAP
my %iso2is = ();
open(FILE, "iso-is.csv") or die();
@lines = <FILE>;
close(FILE);

foreach(@lines) {
    my ($iso, $name) = split(/,/, $_);
    if (!$iso2is{$iso}) {
        chomp($name);
        $iso2is{$iso} = $name;
    }
}

# Print mapping

use Data::Dumper;

# print Dumper(\%en2iso);
# print Dumper(\%iso2is);
# 
# foreach my $en(sort(keys(%en2iso))) {
#     my $iso = $en2iso{$en};
#     my $icelandic = $iso2is{$iso};
#     
#     print "$en --> $iso --> $icelandic\n";
# }



# READ IN MAP HTML

open(FILE, "kort-base.php") or die;
@lines = <FILE>;
close(FILE);

my $file = join('', @lines);
my $dupl = $file;

while ($file =~ m/alt=\"(.+)\" href?/ig) {
    # print $1 . "\n";
    
    my $iso = $en2iso{$1} ? $en2iso{$1} : "?";
    my $icelandic = $iso2is{$iso} ? $iso2is{$iso} : "?";
    my $tag = tagify($icelandic);
    
    print "$1 --> $iso --> $icelandic --> " . $tag . "\n";
    
    my $rep_str = "title=\"$icelandic\" alt=\"$icelandic\" data-tag=\"$tag\" data-iso=\"$iso\" data-en-title=\"$1\" href";
    $dupl =~ s/title=\"$1\" alt=\"$1\" href?/$rep_str/ig;
}





print $dupl;



sub tagify {
    my ($str) = @_;
    
    $str =~ s/\s+/-/ig;
    return lc(AsciifyChars($str));
}



sub AsciifyChars
{
    my ($str) = @_;

    $str =~ s/ð/d/g;
    $str =~ s/Ð/D/g;
    $str =~ s/Á/A/g;
    $str =~ s/á/a/g;
    $str =~ s/ú/u/g;
    $str =~ s/Ú/U/g;
    $str =~ s/Í/I/g;
    $str =~ s/í/i/g;
    $str =~ s/É/E/g;
    $str =~ s/é/e/g;
    $str =~ s/þ/th/g;
    $str =~ s/Þ/Th/g;
    $str =~ s/ó/o/g;
    $str =~ s/Ó/O/g;
    $str =~ s/ý/y/g;
    $str =~ s/Ý/Y/g;
    $str =~ s/ö/o/g;
    $str =~ s/Ö/O/g;
    $str =~ s/æ/ae/g;
    $str =~ s/Æ/Ae/g;
    $str =~ s/ /_/g;
    
    return $str;
}
