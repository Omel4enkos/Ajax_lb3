const ajax = new XMLHttpRequest();
function First() {
    let publisher = document.getElementById("publish").value;
    let second_table = document.getElementById("year-table");
    let third_table = document.getElementById("author-table");
    second_table.classList.add("none");
    third_table.classList.add("none");
    let msg = document.getElementById('msg');
    let select = document.getElementById("publish").options[0].value;
    if (publisher == select){
        msg.classList.remove("none");
        msg.innerText = "Вы не выбрали издательство";
        second_table.classList.add("none");
        third_table.classList.add("none");
    }
    else{
        second_table.classList.add("none");
        third_table.classList.add("none");
        ajax.open("POST","include/book_publisher.php?");
        ajax.onreadystatechange = function(){
            let none = document.getElementById("book-table");
            none.classList.remove("none");
            msg.classList.add("none");
            if(ajax.readyState === 4){
                if(ajax.status === 200){
                    document.getElementById("res").innerHTML = ajax.responseText;
                }
            }
        }
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("publisher=" + publisher);
    }
}
function Second() {
    let first_table = document.getElementById("book-table");
    let third_table = document.getElementById("author-table");
    first_table.classList.add("none");
    third_table.classList.add("none");
    let year = document.getElementById("year");
    let none = document.getElementById("year-table");
    let array_year = [];
    for(let i=0;i<year.options.length;i++){
        if(year.options[i].selected){
            array_year.push(year.options[i].value);
        }
    }
    let first_year = array_year[0];
    let last_year = array_year[array_year.length-1];
    let first_date = first_year + "-01-01";
    let last_date = last_year + "-01-01";
    if(first_year==last_year){
        msg.classList.remove("none");
        msg.innerText = "Вы не выбрали конечный год издания";
        none.classList.add("none");
        first_table.classList.add("none");
        third_table.classList.add("none");
    }
    else{
        ajax.open("Post","include/year.php?");
        ajax.onreadystatechange = function(){
            if(ajax.readyState === 4){
                if(ajax.status === 200) {
                    let res = document.getElementById("res2");
                    let result = "";
                    if (ajax.responseXML == null) {
                        msg.classList.remove("none");
                        msg.innerText = "Нет данных с такими годами";
                        none.classList.add("none");
                        first_table.classList.add("none");
                        third_table.classList.add("none");
                    } else {
                        none.classList.remove("none");
                        msg.classList.add("none");
                        first_table.classList.add("none");
                        third_table.classList.add("none");
                        let rows = ajax.responseXML.firstChild.children;
                        for(let i=0;i<rows.length;i++){
                            result+="<tr>";
                            result+="<td>" + rows[i].children[0].textContent + "</td>";
                            result+="<td>" + rows[i].children[1].textContent + "</td>";
                            result+="<td>" + rows[i].children[2].textContent + "</td>";
                            result+="<td>" + rows[i].children[3].textContent + "</td>";
                            result+="<td>" + rows[i].children[4].textContent + "</td>";
                            result+="<td>" + rows[i].children[5].textContent + "</td>";
                            result+="<td>" + rows[i].children[6].textContent + "</td>";
                            result+="<td>" + rows[i].children[7].textContent + "</td>";
                            result+="<td>" + rows[i].children[8].textContent + "</td>";
                            result+="</tr>";
                        }
                        res.innerHTML = result;
                    }
                }
            }
        }

        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("first_year=" + first_year + "&last_year=" + last_year+ "&first_date=" + first_date+ "&last_date=" + last_date);
    }
}
function Third() {
    let authors = document.getElementById("author").value;
    ajax.open("Get","include/book-authors.php?authors=" + authors,true);
    let none = document.getElementById("author-table");

    let first_table = document.getElementById("book-table");
    let second_table = document.getElementById("year-table");
    first_table.classList.add("none");
    second_table.classList.add("none");

    let select = document.getElementById("author").options[0].value;
    if (authors == select){
        msg.classList.remove("none");
        msg.innerText = "Вы не выбрали автора";
        first_table.classList.add("none");
        second_table.classList.add("none");
    }
    else {
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                if (ajax.status === 200) {
                    let res = JSON.parse(ajax.response);
                    let table3 = document.getElementById("res3");
                    let result = "";
                    if (ajax.response =="[]") {
                        msg.classList.remove("none");
                        msg.innerText = "Такой автор еще не написал книгу";
                        none.classList.add("none");
                        first_table.classList.add("none");
                        second_table.classList.add("none");
                    } else {
                        none.classList.remove("none");
                        msg.classList.add("none");
                        first_table.classList.add("none");
                        second_table.classList.add("none");
                        for (let i in res) {
                            result += "<tr>";
                            result += "<td>" + res[i]['book'] + "</td>";
                            result += "<td>" + res[i]['isbn'] + "</td>";
                            result += "<td>" + res[i]['publisher'] + "</td>";
                            result += "<td>" + res[i]['year'] + "</td>";
                            result += "<td>" + res[i]['quantity'] + "</td>";
                            result += "<td>" + res[i]['name'] + "</td>";
                            result += "</tr>";
                        }
                        table3.innerHTML = result;
                    }
                }
            }
        }
        ajax.send();
    }
}