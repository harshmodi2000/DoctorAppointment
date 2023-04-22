<?php
class Slot{	

public static function getSlots($array,$duration,$margin)
	{
		$final=array();
		foreach ($array as $timeslot) {
		$start=strtotime($timeslot['start']);
		$loopend=strtotime($timeslot['end'])+$margin*60;
		$end=0;
				while($end+$margin*60<=$loopend)
				{	

					$end=$start+$duration*60;
					array_push($final,date('g:i A',$start));
					$start=$end;
				}	
		}
		return $final;

	}	
public static function parseSlot($array)
{
	$count=0;
	$result=array();
	foreach ($array as $timetable) {
		$result[$count]['days']=explode('-',$timetable['days']);
		if(isset($timetable['time1'])&&!empty($timetable['time1']))
		{$result[$count]['time1']=explode('-',$timetable['time1']);}
		if(isset($timetable['time2'])&&!empty($timetable['time2']))
		$result[$count]['time2']=explode('-',$timetable['time2']);
		if(isset($timetable['time3'])&&!empty($timetable['time3']))
		$result[$count]['time3']=explode('-',$timetable['time3']);
		if(isset($timetable['time4'])&&!empty($timetable['time4']))
		$result[$count]['time4']=explode('-',$timetable['time4']);
		$count++;
	}
	return $result;
}

public static function arrangeSlot($array,$date)
{
$count=0;
$day=strtoupper(DateTime::createFromFormat("Y-m-d", $date)->format('D'));
$result=array();
foreach ($array as $timetable) {
	if(in_array($day,$timetable['days']))
	{
		if(isset($timetable['time1'])&&!empty($timetable['time1']))
		{
			$result[$count]['start']=reset($timetable['time1']);
			$result[$count]['end']=end($timetable['time1']);
			$count++;
		}
		if(isset($timetable['time2'])&&!empty($timetable['time2']))
		{
			$result[$count]['start']=reset($timetable['time2']);
			$result[$count]['end']=end($timetable['time2']);
			$count++;
		}
		if(isset($timetable['time3'])&&!empty($timetable['time3']))
		{
			$result[$count]['start']=reset($timetable['time3']);
			$result[$count]['end']=end($timetable['time3']);
			$count++;
		}
		if(isset($timetable['time4'])&&!empty($timetable['time4']))
		{
			$result[$count]['start']=reset($timetable['time4']);
			$result[$count]['end']=end($timetable['time4']);
			$count++;
		}
		break;
	}else{
		continue;
		}
	}
	return $result;
}

}