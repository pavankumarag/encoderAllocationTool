#!/usr/bin/perl
 
use Dancer;
use strict;
use warnings;
use Text::CSV;

## Our file locations, We can change if necessary!!
our $file = "./2014-09-07.csv";
our $file1 = "./EventDefinitions.csv";
our %file_attachments=();
our $htmlIndex=undef;
our $htmlBlank=undef;

sub load_def(){ 
## We need to cache the EventDefinitions.csv ,So opening it!!
open my $fh, "<", $file1 or die "$file1: $!";

## Processing part ,getting line by line
my $csv = Text::CSV->new ({ binary => 1, auto_diag => 1 });
$csv->column_names ($csv->getline ($fh)); # use header

## Caching the contents of EventDefinitions.csv 
while (my $row = $csv->getline_hr ($fh)) {
         $file_attachments{"$row->{event_definition_id}"}{ 'subsystem_id'} = $row->{subsystem_id};
         $file_attachments{"$row->{event_definition_id}"}{ 'active'} = $row->{active};
         $file_attachments{"$row->{event_definition_id}"}{ 'category'} = $row->{category};
         $file_attachments{"$row->{event_definition_id}"}{ 'name'} = $row->{name};
         $file_attachments{"$row->{event_definition_id}"}{ 'description'} = $row->{description};
}

## Now keep track of how many elements are in the parent hash..             
my $file_no = scalar(keys(%file_attachments));
close $fh;
};	#end of event def file load

sub load_data(){
## Opening the secod file EventInstance1/2014-09-07.csv
my $host_ip = param('host_ip');
my $host_name =param('host_name');
my $event_time =param('event_time');
my $event_category= param('event_category');
my $active=param('active');

open my $fh1, "<", $file or die "$file: $!";

## Processing part ,getting line by line
my $csv = Text::CSV->new ({ binary => 1, auto_diag => 1 });
$csv->column_names ($csv->getline ($fh1)); # use header

## Then lets define our hash of hashes.
my %file_attachments1;
my $buffer = "";
## Caching the contents of EventDefinitions.csv only the user defined fields
while (my $row = $csv->getline_hr ($fh1) ) {
    if ($row->{host_name} eq $host_name){
                $buffer .= "event_definition_id:" . $row->{event_definition_id} . "\taccount_id:" . $row->{account_id} . "\tevent_time:" . $row->{event_time} . "<br>";
    }
}
my $formData=sprintf($htmlBlank,$buffer);
my $file_no = scalar(keys(%file_attachments1));

close $fh1;
return $formData;
};

$htmlIndex='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Data Analysis</title>
<meta name="keywords" content="free blog template, css template, CSS, HTML" />
<meta name="description" content="Green Web Blog - free blog template provided by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_header_content_container">    
        <div id="templatemo_header_section">
            <div id="templatemo_title_section">
        <pre>    EVENT DATA ANALYSIS </pre>
        </div> <!-- end of templatemo header panel -->
     </div>
        <div id="templatemo_content">

            <div id="templatemo_content_left">
		<h3>DATA ANALYSIS MYSTERY</h3>
<form action="/clicked" method="get"><pre>
<p>Host_IP          :  <input type="text" name="host_ip"><br>
Host_name        :  <input type="text" name="host_name"><br>
Event_Time       :  <input type="text" name="event_time"><br>
Event_Category   :  <select>
 <option value="audit"> AUDIT </option>
 <option value="alert"> ALERT </option>
 <option value="security"> SECURITY </option>
<option value="all">ALL</option>
</select><br>
Active           :  <select>
 <option value="one"> 1 </option>
 <option value="zero"> 0 </option>
</select><br>
                    <input type="submit" style="color:orange;font:arial bold;background-color:blue;" value=" DISPLAY "> </pre>
</p><p>Click the "DISPLAY" button to get the processed data</p>	
</form>	
                    </div>
 <div id="templatemo_right_section">
<pre>
 <img src="images/da.jpg" alt="Not displayed"/> </pre>
</div>
</div>                    
	    </div> <!-- end of content -->
    </div> <!-- end of content container -->
</html>';

$htmlBlank='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Data Analysis</title>
<meta name="keywords" content="free blog template, css template, CSS, HTML" />
<meta name="description" content="Green Web Blog - free blog template provided by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_header_content_container">    
        <div id="templatemo_header_section">
            <div id="templatemo_title_section">
        <pre>    EVENT DATA ANALYSIS </pre>
        </div> <!-- end of templatemo header panel -->
     </div>
        <div id="templatemo_content">
            <div id="templatemo_content_left">"%s"
</div> 
<div id="templatemo_right_section">
</div>
	    </div> <!-- end of content -->
    </div> <!-- end of content container -->';



sub onClick(){
	return "Button clicked with ".param('hostip');
};

get '/' => sub {
	send_file 'templatemo_style.css';
	send_file 'images';
	load_def();
};

get '/index' => sub {
	return $htmlIndex;
	#return '<form action="/clicked" method="GET"><label for="label2">Enter the value</label> <input type="text" value="Some value" name="label_1"/><input type="submit" value="Execute"/></form>';
};
get '/clicked' => sub {
	#onClick();
	load_data();
};

dance;
