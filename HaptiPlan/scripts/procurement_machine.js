
fetch("http://localhost/Haptiplan-Frontend/HaptiPlan/machine")
.then(respone => respone.json())
.then(function(machines){
    var machineList = document.getElementById("machineList");
 
    machines.forEach(function (machine) {
        var machineItem = document.createElement("li");
        machineItem.innerHTML = "Name: " + machine.name;
        machineList.appendChild(machineItem);
    });
})







/*.then(function (posts) { 
    var output ='<table style ="border: 1px solid blue;"><tr>';
    for (const post of posts) {
        output += '<td>' + post.id + '</td>' + '<td>' + post.title + '</td></tr>';

    }
    output +='</table>';

      document.getElementById('posts').innerHTML = output;
 });
*/