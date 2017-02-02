<article class="les les1">
    <header>
        <span>
            Первое занятие
        </span>
    </header>
    <section>
        <canvas id="pic1" width="200" height="200">
            fd
        </canvas>
    </section>
</article>

<article class="les les2">
    <header class="titleArticle">
        <span>
            Второе занятие
        </span>
    </header>
    <section>
        <form oninput="bbb.value=range.value">
            <input name="ip" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}">
            <input type="url" name="ggg">
            <input min="1" max="900" type='range' name="range" oninput="ggg.value = range.value">
            <output name="bbb"></output>

        </form>
    </section>
</article>

<article class="les">
    <header>
        <span>
            домашка
        </span>
    </header>
    <section class="les3">
        <canvas id="pic3" width="200" height="200">
            Обновите браузер
        </canvas>
        <script>
            var myPic = document.getElementById("pic3"),
                picture = myPic.getContext('2d');
            picture.strokeStyle = "white";
            picture.shadowBlur = 20;
            picture.shadowColor = "rgba(0,0,0,0.5)";
            picture.shadowOffsetX = 0;
            picture.shadowOffsetY = 0;
            picture.lineWidth = 7;

            picture.beginPath();
            picture.moveTo(40, 120);
            picture.lineTo(65, 70);
            picture.lineTo(90, 120);
            picture.moveTo(52.5, 95);
            picture.lineTo(77.5, 95);

            picture.moveTo(110, 120);
            picture.lineTo(135, 70);
            picture.lineTo(160, 120);
            picture.moveTo(122.5, 95);
            picture.lineTo(147.5, 95);
            //picture.lineTo(75, 70);
            //picture.lineTo(20, 70);
            picture.closePath();
            picture.stroke();
        </script>
    </section>

    <section class="les3">
        <canvas id="pic4" width="200" height="200">
            Обновите браузер
        </canvas>
        <script>
            var myPic = document.getElementById("pic4"),
                picture = myPic.getContext('2d');
            picture.strokeStyle = "black";
            picture.beginPath();
            picture.moveTo(55, 120);
            picture.lineWidth = 3;
            picture.lineTo(70, 70);
            picture.lineTo(85, 120);
            picture.moveTo(62.5, 95);
            picture.lineTo(77.5, 95);
            picture.moveTo(120, 75);
            picture.arc(120, 75, 10, 1.5 * Math.PI, 2.5 * Math.PI);
            picture.arc(120, 100, 17, 1.5 * Math.PI, 2.5 * Math.PI);

            //picture.lineTo(75, 70);
            //picture.lineTo(20, 70);
            picture.closePath();
            picture.stroke();
        </script>
    </section>

    <section class="les3">
        <canvas id="pic5" width="200" height="200">
            Обновите браузер
        </canvas>
        <script>
            var myPic = document.getElementById("pic5"),
                picture = myPic.getContext('2d');
            picture.lineWidth = 2;
            picture.shadowBlur = 5;
            picture.shadowColor = "rgba(0,0,0,0.7)";
            picture.shadowOffsetX = 2;
            picture.shadowOffsetY = 2;
            picture.strokeStyle = "black";
            picture.beginPath();
            picture.moveTo(50, 120);
            picture.bezierCurveTo(60, 140, 115, 10, 75, 122);
            picture.moveTo(66, 100);
            picture.lineTo(87, 100);

            picture.moveTo(100, 120);
            picture.bezierCurveTo(110, 140, 165, 10, 125, 122);
            picture.moveTo(116, 100);
            picture.lineTo(137, 100);
            picture.closePath();
            picture.stroke();
        </script>
    </section>

</article>


<article class="les">
    <header>
        <span>
            Третье занятие
        </span>
    </header>
    <section>
        <canvas id="svg" width="400" height="400">
            Update your browser
        </canvas>
        <script>
            var m1 = document.getElementById("svg"),
                con = m1.getContext('2d'),
                pi = new Image();
            pi.src = '1.png';
            pi.onload = function() {
                con.drawImage(pi, 10, 10);
            }


        </script>
        <!--
        var m1 = document.getElementById("svg"),
        p1 = m1.getContext('2d'),
        nm = new Image();
        nm.scr = '1.png';
        nm.onload = function() {
        p1.drawImage(nm, 10, 10);

        }


        var pic_canvas = document.getElementById("svg"),
        context = pic_canvas.getContext('2d'),
        pic = new Image();
        pic.src = '1.png';
        pic.onload = function() {
        context.drawImage(pic, 10, 10);

        }
        -->
    </section>
    <section>
        <svg width="400" height="400">
            <polygon points ="200,10 250,190 160,210" style="fill: #66fff8">

            </polygon>
        </svg>
    </section>
    <section>
        <svg width="400" height="400">
            <path d="M150 0 L75 200 L225 200 Z" style="fill:#b90e13"/>
        </svg>
    </section>
    <section>
        <svg width="400" height="400">
            <path d="M150 0 Q130 180 75 200 L200 Z" style="fill:#a797c6"/>
        </svg>
    </section>
    <div>
        <svg width="400" height="400">
            <line x1='25' y1="150" x2='300' y2='150' style='stroke:#831a37'/>
        </svg>
    </div>
    <div>
        <svg width="400" height="400">
            <polyline points ="0,20 20,20 20,40 40,40 40,60 60,60 60,80 80,80 100,80 100,100" style="fill:white;stroke:#802217"/>
            <rect width="10" height="10" style="fill:#412c80"/>
            <circle cx="200" cy="200" r="40" fill="red"/>
            <ellipse cx="150" cy="300" rx="110" ry="40" style="fill:#77f0ff;"/>
        </svg>
    </div>
    <div>
        <svg width="200" height="200">
            <polyline points ="40,120 65,70 90,120 " style="fill:white;stroke:#802217"/>
            <polyline points ="52.5,95 77.5,95" style="fill:white;stroke:#802217"/>
            <polyline points ="110, 120 135, 70 160, 120 " style="fill:white;stroke:#802217"/>
            <polyline points ="122.5, 95 147.5, 95" style="fill:white;stroke:#802217"/>

        </svg>
    </div>
    <div>
        <svg width="200" height="200">
            <polyline points ="40,120 65,70 90,120 " style="fill:white;stroke:#802217"/>
            <polyline points ="52.5,95 77.5,95" style="fill:white;stroke:#831a37"/>
            <polyline points ="52.5,95 77.5,95" style="fill:white;stroke:#831a37"/>
            <polyline points ="120, 70 120, 120" style="fill:white;stroke:#831a37"/>
            <path d="M120,70 C135,70  135,90  120,90" style="fill: none; stroke:#831a37"/>
            <path d="M120,90 C145,90  145,120  120,120" style="fill: none; stroke:#831a37"/>



        </svg>
    </div>

</article>






