/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(typeof Following === 'undefined'){
    var Following = {};
}

Following.menu = function(){
    $('#menu-left li').click(function(){
        $('#menu-left li').removeClass('active');
        $(this).addClass('active');
    })
    
    if($('section').is(':visible')){
        $('#menu-left li').removeClass('active');
        var id = $('section').attr('id');
        $('#nav-'+id).addClass('active');
    }
}

Following.checkAll = function(checkbox, stub) {
    if (!stub) {
        stub = 'cb';
    }
    
    if (typeof(form) === 'undefined') {
		form = document.getElementById('adminForm');
		if(!form){
			form = document.adminForm;
		}
	}

    if (checkbox.form) {
        var c = 0;
        for (var i = 0, n = checkbox.form.elements.length; i < n; i++) {
            var e = checkbox.form.elements[i];
            if (e.type == checkbox.type) {
                if ((stub && e.id.indexOf(stub) == 0) || !stub) {
                    e.checked = checkbox.checked;
                    c += (e.checked == true ? 1 : 0);
                }
            }
        }
        if (checkbox.form.boxchecked) {
            checkbox.form.boxchecked.value = c;
        }
        return true;
    }
    return false;
}

Following.tableNewRow = function(element){
    var last = element.closest('table').children('tbody').children('tr:last');
    var first = element.closest('table').children('tbody').children('tr:first');
    var count = element.closest('table').children('tbody').children('tr').length-1;
    var next = count+1;
    var clone = last.clone();
    
    clone.find('input, select').each(function(){
        var name = $(this).attr('name').replace('['+count+']', '['+next+']');
        $(this).attr('name', name);
    });
    
    clone.children('td:last').find('a').attr({'class':'table-btn-minus','id':''});
    clone.find(':input').val('');
    last.after(clone);
}

Following.tableRemoveRow = function(element){
    element.closest('tr').remove();
}

Following.showPassword = function(element){
    var interval = 0;

    element.bind('click mousedown', function() {
        interval = setTimeout(
            $(this).prev().attr('type', 'text')
        , 10000);
    }).bind('mouseup mouseleave', function() {
        clearTimeout(interval);
        $(this).prev().attr('type', 'password');
    });
}

Following.isChecked = function(isitchecked, form) {
	if (typeof(form) === 'undefined') {
		form = document.getElementById('adminForm');
		/**
		 * Added to ensure Joomla 1.5 compatibility
		 */
		if(!form){
			form = document.adminForm;
		}
	}

	if (isitchecked == true) {
		form.boxchecked.value++;
	} else {
		form.boxchecked.value--;
	}
}

/*
 * var messages = {
        "0":{"type":"info", "message":"aaaaaaaa"},
        "1":{"type":"error", "message":{"0":"ddddddddd","1":"eeee","2":"ffff"}},
        "2":{"type":"success", "message":{"0":"gggg","1":"hhhhh","2":"iiii"}}
    }
 */
Following.renderMessageList = function(messages, instance) {
    
    Following.removeMessages();
    
    var container = document.createElement("div");
    container.setAttribute('id', 'system-message-container');

    for (k in messages) {
        var button = document.createElement("button");
        button.setAttribute("data-dismiss", "alert");
        button.setAttribute("class", "close");
        button.setAttribute("html", "error");
        button.setAttribute("type", "button");
        button.appendChild(document.createTextNode("×"));

        container.appendChild(button);

        var dl = document.createElement('dl');
        dl.setAttribute("id", "system-message");
        var dt = document.createElement("dt");
        dt.setAttribute("class", messages[k].type);
        dt.appendChild(document.createTextNode(messages[k].type));
        dl.appendChild(dt);

        var dd = document.createElement("dd");
        dd.setAttribute("class", messages[k].type);
        dd.classList.add("message");

        var span = document.createElement("span");
        span.setAttribute("class", "message-status-icon");

        dd.appendChild(span);
        var list = document.createElement("ul");
        
        if (typeof(messages[k].message) == 'object') {
            for (i in messages[k].message) {
                var li = document.createElement("li");
                li.appendChild(document.createTextNode(messages[k].message[i]));
                list.appendChild(li);
            }
        } else {
            var li = document.createElement("li");
            li.appendChild(document.createTextNode(messages[k].message));
            list.appendChild(li);
        }

        dd.appendChild(list);
        dl.appendChild(dd);
        container.appendChild(dl);

        $(instance).prepend(container);

    }
}

/*
 * var m = {
        "message":"aaaaaaaa","type":"success"
    }
 */
Following.renderMessages = function(messages, instance) {
    
    Following.removeMessages();
    
    var container = document.createElement("div");
    container.setAttribute('id', 'system-message-container');

    var button = document.createElement("button");
    button.setAttribute("data-dismiss", "alert");
    button.setAttribute("class", "close");
    button.setAttribute("html", "error");
    button.setAttribute("type", "button");
    button.appendChild(document.createTextNode("×"));
    container.appendChild(button);

    var dl = document.createElement('dl');
    dl.setAttribute("id", "system-message");
    
    var dt = document.createElement("dt");
    dt.setAttribute("class", messages.type);
    dt.appendChild(document.createTextNode(messages.type));
    dl.appendChild(dt);

    var dd = document.createElement("dd");
    dd.setAttribute("class", messages.type);
    dd.classList.add("message");

    var span = document.createElement("span");
    span.setAttribute("class", "message-status-icon");

    dd.appendChild(span);
    var list = document.createElement("ul");

    var li = document.createElement("li");
        li.appendChild(document.createTextNode(messages.message));
        list.appendChild(li);

    dd.appendChild(list);
    dl.appendChild(dd);
    container.appendChild(dl);
    $(instance).prepend(container);
}

Following.removeMessages = function() {
	$('#system-message-container').remove();
}