/** FILE READER **/

function loadFile(inputFile)
{
	
	if (window.XMLHttpRequest)
	{	
		// code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp = new XMLHttpRequest();
	}
	else
	{	
		// code for IE6, IE5
	    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET", inputFile, false);
	//xmlhttp.overrideMimeType("text/plain; charset=x-user-defined");
	xmlhttp.send();
	
	var lines = xmlhttp.responseText.split("]0;");

	//console.log(lines);
	for(var i = 0; i < lines.length; i++)
    {
    	if(lines[i].length > 2)
			parseLine(lines[i]); 
    }

    var callback = function printOutput(output){
    	if(output != "")
    		$("#caption").append("<br />");
    	
    	$("#caption").append(output);
    	$("#caption").append('<br/>');
    	$(".terminal").scrollTop(1000000);
    }

    print(data, 0, data.length, callback);

	//console.log(data);
}

function parseLine(line)
{
	var object = new Object();

	hostName = getHostname(line);
	if(hostName == -1)
	{
		object.line 	= data.length + 1;
		object.hostName = -1;
		object.commands = -1;
		object.output	= line;
		object.delay	= 500;
	}
	else
	{
		object.line 	= data.length + 1;
		object.hostName = getHostname(line);
		object.commands = getCommands(line);
		object.output	= getOutput(line);
		
		if (object.commands == -1)
			object.delay = 2;
		else
			object.delay = object.commands.length;
	}
	
	data.push(object);
}

function getHostname(line)
{
    var regex 	 = /((?:[a-zA-Z][a-zA-Z]+))(@)((?:[a-zA-Z][a-zA-Z]+))(:)(\s)(~)(.)((?:[a-zA-Z][a-zA-Z]+))(@)((?:[a-zA-Z][a-zA-Z]+))(:~#)/gmi; 
    var res 	 = regex.exec(line);
    
    if (res == null)
    	return -1;
    else
    	return res[0];
}

function getCommands(line)
{
	var regex = /((?:[a-zA-Z][a-zA-Z]+))(@)((?:[a-zA-Z][a-zA-Z]+))(:)(\s)(~)(.)((?:[a-zA-Z][a-zA-Z]+))(@)((?:[a-zA-Z][a-zA-Z]+))(:~#\s)(.+)/gmi; 
	var res = regex.exec(line);
	var commands = "";
	
	if (res == null)
	{
		return -1;
	}
	else
	{
		for(var i = 12; i < res.length; i++)
		{
			if(res[i] == "\n")
				break;

			commands += res[i];
		}
	}
		
	return commands;
}

function getOutput(line)
{
	var output = "";
	var search = line.indexOf('\n');

	if (search + 2 >= line.length)
		return -1;
	else
		for(var i = search + 1; i < line.length; i++)
			output += line[i];

	return output.substring(0, output.length - 2);
}

function type(line, callback, output) 
{
	$("#caption").append(line[0]);
	if (line.length == 0)
	{
		callback(output);
		return 0;
	}
	setTimeout(
			function(){
				type(line.slice(1), callback, output);            
			},200                 
	);
}

function print(data, current, max, callback)
{
	if(current == max)
	{
		for(var i = 0; i< timer.length; i++)
			clearTimeout(timer[i]);
		return 0;
	}

	if(timer.length >= 1)
	{
		var oldTimer = timer[0];
		clearTimeout(oldTimer);
		timer = timer.slice(1);
	}
	
	if (data[current].hostName != -1)
		var hostName = data[current].hostName;
	else
		var hostName = "";
	
	if(data[current].commands != -1) 
		var commands = data[current].commands.replace(/\n/g, "<br />").replace(/\07/g, ""); 
	else 
		var commands = "";
	
	if(data[current].output != -1)   
		var output = data[current].output.replace(/\n/gmi, "<br />").replace(/\t/g, "&nbsp;&nbsp;");
	else
		var output = "";
	
	if(hostName == "" && output != "")
	{
		callback(output);
		timer.push(setInterval(function(){print(data, current + 1, max, callback)}, 500));	
	}
	else
	{
		console.log(data[current]);

		$("#caption").append(data[current].hostName + " ");
		type(commands, callback, output);		
			
		timer.push(setInterval(function(){print(data, current+1, max, callback)}, data[current].delay*200 + 200));
	}

}

function cursorAnimation() {
    $('#cursor').animate({
        opacity: 0
    }, 'fast', 'swing').animate({
        opacity: 1
    }, 'fast', 'swing');
}


