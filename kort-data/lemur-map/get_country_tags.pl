#!/usr/bin/perl -w

use WWW::Google::Translate;

# Read in IS country names
open(FILE, "is-countries.txt") or die();
@countries = <FILE>;
close(FILE);

# Read in tag to post_count map, filter out
# those tags that are not country names
open(FILE, "tags2post_count.txt") or die();
@lines = <FILE>;
close(FILE);

my %is_country2post;
foreach(@lines) {
    ($tag, $count) = split(/,/, $_);
    if (in_array($tag, \@countries)) {
        $count =~ s/\n$//;
        $is_country2post{$tag} = $count;
    }
}

# foreach my $key(sort(keys(%is_country2post))) {
#     print "$key --> $is_country2post{$key}\n";
# }


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

# Iterate and do the real work
my @failmatches;
foreach my $key(sort(keys(%iso2is))) {
    my $iso = $key;
    my $iso_cn = $iso2is{$iso};
    
    foreach my $key(sort(keys(%is_country2post))) {
        my $count_map_cn = $key;
        my $post_count = $is_country2post{$key};
        
        if (country_names_match($iso_cn, $count_map_cn)) {
            print "'$iso_cn'<-->'$count_map_cn'| --> $post_count\n";
        } else {
            push(@failmatches, $count_map_cn);
        }
        
    }
    
    
}

# print scalar(@failmatches) . " failed:\n\n";
# foreach (@failmatches) {
#     print $_ . "\n";
# }

# Util subroutines

sub country_names_match {
    my ($n1, $n2) = @_;
    if ($n1 =~ /$n2/i or $n2 =~ /$n1/i) {
        return 1;
    }
    return 0;
}

sub in_array {
    my ($s, $array_ref) = @_;
    
    foreach (@$array_ref) {
        $_ =~ s/\n$//; 
        if ($s eq $_) {
            return 1;
        }
    }
    return 0;
}