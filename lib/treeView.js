/**
 * Created by matq007 on 11/10/14.
 */

var htmlTree = "";

function treeView(tree)
{
    htmlTree += "<ul>";

    for(item in tree)
    {
        if(typeof tree[item] == "string")
        {
            htmlTree += "<li class=\"file\"><span class=\"glyphicon glyphicon-file\"></span>&nbsp;" + tree[item] + "</li>";
        }
        if(typeof tree[item] == "object")
        {
            htmlTree += "<ul>";
            htmlTree += "<li class=\"folder\"><span class=\"glyphicon glyphicon-folder-close\"></span> " + item + "</li>";
            treeView(tree[item]);
            htmlTree += "</ul>";
        }
    }

    htmlTree += "</ul>";

    return htmlTree;
}