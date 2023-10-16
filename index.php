</html>
    <head>
        Welcome to Our Website
        <meta>it202 class</meta>
        <script>
            console.log("sample javasript")
            var a = 1+2
        </script>
        <link rel= "stylesheet" href="demo.css"/>
    <head>
    <body>
        <p>test code</p>
        <form method = "post">
            Search: <input type= "text" name="name">
            <input type ="text" name="second">
            <input type="submit">

        </form>
        <?php 
            if(isset($_POST["name"])){
                echo $_POST["name"];
            }
        ?>
        <button onclick = "alert('Alert Box')">Alert Pop Up</button>

        <h1>first website with edits</h1>
        <hr>
        <h3>Second Heading</h3>
        <br>
        <a href="https://www.apple.com">Apple website</a>
        <p>This<strong> is a</strong>  paragraph</p>
        <button>test</button>
        <img src=https://www.google.com/imgres?imgurl=https%3A%2F%2Fwww.thedrive.com%2Fcontent%2F2022%2F03%2Fmessage-editor_1647969272214-2022_arctic_grey_718_cayman_gt4rs_041_mu901412.jpg%3Fquality%3D85&tbnid=QK8t8RflnvrlQM&vet=12ahUKEwir6-HQ68uBAxUWJVkFHZGSBK8QMygBegQIARB3..i&imgrefurl=https%3A%2F%2Fwww.thedrive.com%2Fnew-cars%2F44863%2F2022-porsche-718-cayman-gt4-rs-first-drive-review-makes-a-hero-out-of-you&docid=BS8DYKF2HO-61M&w=1920&h=1080&q=gt4rs&ved=2ahUKEwir6-HQ68uBAxUWJVkFHZGSBK8QMygBegQIARB3>
        <?php
        echo "testphp\n";
        $test2 = "testphpvariable\n";
        $math= 5+3;
        echo $math;
        echo $test2;

        if ($math==8){
            echo "value is 8";
        }
        ?>



    </body>
</html>