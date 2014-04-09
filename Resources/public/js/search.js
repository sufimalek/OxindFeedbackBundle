
/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Description of FeedbackFilter
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */


function loadSearchlist(feedbacktype_id, url)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("feedback-list-container").parentNode.innerHTML = xmlhttp.responseText;
        }
    }
    var query = document.getElementById('query').value;
    var serverquery = encodeURI("?q=" + query + "&feedbacktype_id=" + feedbacktype_id);

    xmlhttp.open("GET", url + serverquery, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.send();
}
