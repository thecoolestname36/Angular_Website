<html>
    <head>

        <style>
            li {
                padding:2px;
            }
            li>a {
                padding:2px;
            }
            li>img {
                display:none;
            }
            li>img.showImg {
                display:block;
                width:50%;
                padding:50px;
            }
        </style>

        <script>
            <?php
            //This function gets the file names of all images in the current directory
            //and ouputs them as a JavaScript array
            function returnimages($dirname=".") {
                $pattern="(\.jpg$)|(\.png$)|(\.jpeg$)|(\.gif$)"; //valid image extensions
                $files = array();
                $curimage=0;
                if($handle = opendir($dirname)) {
                    while(false !== ($file = readdir($handle))){
                        if(eregi($pattern, $file)){ //if this file is a valid image
                            //Output it as a JavaScript array element
                            echo 'galleryarray['.$curimage.']="'.$file .'";';
                            $curimage++;
                        }
                    }
                    closedir($handle);
                }
                return($files);
            }
             
            echo 'var galleryarray=new Array();'; //Define array in JavaScript
            returnimages() //Output the array elements containing the image file names
            ?>
        </script>

        <script type="text/javascript">

            function populateList(list) {
                var imgList = document.getElementById("imageList");                

                for(var i=0; i<list.length; i++) {
                    var imgName = list[i];

                    var li = document.createElement("li");

                    var a = document.createElement("a");
                    a.setAttribute('href', imgName);
                    a.appendChild(document.createTextNode(imgName));

                    var button = document.createElement("button");
                    button.setAttribute('name', imgName);
                    button.setAttribute('type', "button");
                    button.setAttribute('onclick', "expand(this.name)");
                    button.appendChild(document.createTextNode("Preview"));

                    var image = document.createElement("img");
                    image.setAttribute('id', imgName);
                    image.setAttribute('src', imgName);

                    li.appendChild(button);
                    li.appendChild(a);                    
                    li.appendChild(image);
                    imgList.appendChild(li);
                }
            }

            function expand(name) {
                console.log("cool:" + name);

                var img = document.getElementById(name);
                var elemClass = img.getAttribute('class');
                if(elemClass == null || elemClass == undefined) {
                    img.setAttribute('class', "showImg");
                } else {
                    img.removeAttribute('class');
                }
                
            }

            window.onload = function() {
               // console.log("Hello: " + galleryarray);
               populateList(galleryarray);
                

            }



        </script>
    </head>

    <body>

        <h1>Images:</h1>
        <ul id="imageList"> 

        </ul>

    </body>

</html>