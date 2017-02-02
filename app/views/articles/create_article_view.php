<div class="topic">
        <span>Создание статьи</span>
</div>

<?php
    $text = parser_text_with_BBCode_into_html(sanitizeString($content));
    $article_title1 =  sanitizeString($article_title);
    if ($flag)
    echo
    <<<EOD
    <span style="color: gray; display: inline-block;margin-top: 10px; font-size: 26px;margin-bottom: 20px;">Предпросмотр:</span>

<article class="full-article preview-article">
    
        <header>
            <span>$article_title1</span>
        </header>
    
    <hr>
    <section>
        <span>$text</b></i></u></s></h1></h2></h3></url></span>
    </section>
<footer class='footerArticle'>
        <span> сейчас | </span>  <a href='' class='author'>Вы</a>

    </footer>
</article>

EOD;

$var = 'fdfd';


?>

<form action='/articles/create/' class='createArticleForm' method='post'>
    <input type='text' name='title' placeholder='Заголовок' value='<?php echo $article_title; ?>' class='create-article-form-title'>
    <div id="drop-down-list-search" class="drop-down-list-search">
        <label for="create-article-form-search">Выберите категорию:</label>
        <input type="hidden" id="create-article-form-hidden-input1" value="false">
        <input type="text" id="create-article-form-search" class="create-article-form-search" name="category" readonly placeholder="..." value="<?php echo $category; ?>">
        <div id="create-article-form-drop-down-list" class="create-article-form-drop-down-list">
            <ul>
                <?php echo $categories; ?>
            </ul>
        </div>
    </div>
    <script>
        document.getElementById('create-article-form-search').onfocus = function (e) {
            showList();

        };

        document.getElementById('super-body').onclick = function(e) {
            if(e.target != document.getElementById('create-article-form-search'))
                hideList();
            else
                showList();
        }

    </script>
    <label for="create_article_textarea">Текст:</label>
    <div class="in_form_textarea">
        <input type="button" value="B" onclick="formatText('b');" style="font-weight:bold" title="Жирный" tabindex="-1">
        <input type="button" value="I" onclick="formatText('i');" style="font-style:italic" title="Курсив" tabindex="-1">
        <input type="button" value="U" onclick="formatText('u');" style="text-decoration:underline" title="Подчёркнутый" tabindex="-1">
        <input type="button" value="S" onclick="formatText('s');" style="text-decoration:line-through" title="Зачеркнутый" tabindex="-1">
        <input type="button" value="img" onclick="formatText('img');" title="Вставить изображение" tabindex="-1">
        <input type="button" value="url" onclick="formatText('url');" title="Вставить ссылку" tabindex="-1">
        <input type="button" value="H1" onclick="formatText('h1');" title="Заголовок" tabindex="-1">
        <input type="button" value="H2" onclick="formatText('h2');" title="Подзаголовок" tabindex="-1">
        <input type="button" value="H3" onclick="formatText('h3');" title="Подподзаголовок" tabindex="-1">
        <textarea id="create_article_textarea" name='content' class=""><?php echo $content; ?></textarea>
        <script>
            var textareas = document.getElementsByName('content');

            for (var i=0;i<textareas.length;i++){
                if (textareas[i].parentNode.tagName.toString().toLowerCase() == 'div') {
                    textareas[i].onfocus = function(){
                        hideList();
                        this.parentNode.style.borderColor = '#CD7F32';
                    };
                    textareas[i].onblur = function(){
                        this.parentNode.style.borderColor = '#dddddd';
                    };

                }
            };
        </script>
    </div>
    <input type="button" class="create-article-form-poll-button" value="Добавить опрос" onclick="showBlock(this, 'create-article-form-poll-block');">
    <div class="create-article-form-poll-block">
        <div class="create-article-form-poll-title">Опрос</div>
        <label>Вопрос:
            <input type="text" class="create-article-form-poll-question">
        </label>
        <label>Варианты ответа:</label>
        <div class="create-article-form-poll-answers">
        <input type="text" class="create-article-form-poll-answer">
        <input type="text" class="create-article-form-poll-answer">
        </div>
        <input type="button" class="create-article-form-poll-add-answer-button" value="+добавить вариант ответа" onclick="addInput('create-article-form-poll-answers')">
    </div>
    <input type='submit' name='publish_button' value='Опубликовать'>
    <input type='submit' name='preview_button' value='Предпросмотр' onclick="">
    <input type="hidden" name="token" value="<?php echo $spec_var; ?>" />
</form>

