<div id="loader" style="position: fixed;height: 100%;width: 100%;left: 0;top: 0;background: var(--light);z-index: 11111;">
    <style type="text/css">
        #loader #pendd1{
            display: block;
            position: fixed;
            top: 20%;
            left: 0;
            right: 0;
            margin: auto;
            height: 100px;
            width: 100px;
            background: transparent;
            border-radius: 50%;
            animation: loader 3s infinite;
            border: 5px solid var(--gray);
            border-top: 5px solid var(--dark);
            border-bottom: 5px solid var(--dark);
        }
        @KeyFrames loader{
            0%{transform: rotate(0deg);}
            100%{transform: rotate(360deg);}
        }
    </style>
    <div id="pendd1"></div>
    <p style="color: var(--dark); display:block; font-size:2rem; font-family: sans-serif; position:absolute; top:45%; left:0; right:0; margin:auto;text-align:center;">Loading</p>
    <script type="text/javascript">
        window.addEventListener("load", function () {
                document.getElementById("loader").innerHTML = "";
                document.getElementById("loader").remove();
        });
    </script>
</div>