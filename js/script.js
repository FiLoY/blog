function formatText(tag) {
    var Field = document.getElementById('create_article_textarea');
    var val = Field.value;
    var selected_txt = val.substring(Field.selectionStart, Field.selectionEnd);
    var selected_txt_last_index = Field.selectionEnd;
    var url = '';


    if (tag == 'img') {
        url = prompt("Введите адрес изображения", "http://");
        if (url) {
            url = '="' + url + '"';
            if (selected_txt) {
                Field.value = replaceRange(Field.value, Field.selectionStart, Field.selectionEnd, '[' + tag + url + ']' + selected_txt);
                // Field.value = Field.value.replace(val.substring(Field.selectionStart, Field.selectionEnd),
                //     '[' + tag + url + ']' + selected_txt);
                Field.setSelectionRange(selected_txt_last_index + (tag.length + 2) + url.length,
                    selected_txt_last_index + (tag.length + 2) + url.length);
            }
            else {
                var before_txt = val.substring(0, Field.selectionStart);
                var after_txt = val.substring(Field.selectionEnd, val.length);
                Field.value = before_txt + '[' + tag + url + ']' + after_txt;
                Field.setSelectionRange(selected_txt_last_index + (tag.length + 2) + url.length,
                    selected_txt_last_index + (tag.length + 2) + url.length);
            }
        }

    }
    else {
        if (tag == 'url') {
            url = prompt("Введите URL ссылки", "http://");
            if (url) {
                url = '="' + url + '"';
            }
            else {
                Field.focus();
                return;
            }
        }

        if (selected_txt) {
            Field.value = replaceRange(Field.value, Field.selectionStart, Field.selectionEnd, '[' + tag + url + ']' + selected_txt + '[/' + tag + ']');
            Field.setSelectionRange(selected_txt_last_index + (tag.length + 2) * 2 + 1 + url.length,
                selected_txt_last_index + (tag.length + 2) * 2 + 1 + url.length);
        }
        else {
            var before_txt = val.substring(0, Field.selectionStart);
            var after_txt = val.substring(Field.selectionEnd, val.length);
            Field.value = before_txt + '[' + tag + url + ']' + '[/' + tag + ']' + after_txt;
            Field.setSelectionRange(selected_txt_last_index + (tag.length + 2) + url.length,
                selected_txt_last_index + (tag.length + 2) + url.length);
        }
    }


    Field.focus();
}


function replaceRange(str, start, end, substitute) {
    return str.substring(0, start) + substitute + str.substring(end);
}




function showList() {
    var searchField = document.getElementById('create-article-form-search');
    var searchList = document.getElementById('create-article-form-drop-down-list');
    searchList.style.display = 'block';
}

function hideList() {
    var searchField = document.getElementById('create-article-form-search');
    var searchList = document.getElementById('create-article-form-drop-down-list');
    var listItem = document.querySelector('form.createArticleForm .create-article-form-drop-down-list > ul > li');
    // alert(listItem.hover == true);
    searchList.style.display = 'none';
}

function touchElement() {
    var searchField = document.getElementById('create-article-form-search');
    var listLi = document.querySelectorAll('form.createArticleForm .create-article-form-drop-down-list > ul > li');
    alert(str);
    searchField.value = str;
}


function showBlock(button, className) {
    if (button.i === undefined) button.i = true;

    var Block = document.getElementsByClassName(className);
    if (button.i == true) {
        button.value = "Убрать опрос";
        Block[0].style.display = 'block';
        button.i = false;
        // alert(button.i);
    } else {
        button.value = "Добавить опрос";
        Block[0].style.display = 'none';
        button.i = true;
    }
}


function addInput(divName){
    if (false)  {
        alert(1);
    }
    else {
        var newdiv = document.createElement('div');
        newdiv.innerHTML = "<input type=\"text\" class=\"create-article-form-poll-answer\">";
        document.getElementsByClassName(divName)[0].appendChild(newdiv);
    }
}


