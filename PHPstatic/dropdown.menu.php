<html>
<head>
<style>
nav {
    margin: 100px auto; 
    text-align: center;
}
 
nav ul ul {
    display: none;
}
 
    nav ul li:hover > ul {
        display: block;
    }
 
 
nav ul {
    background: #efefef; 
    background: linear-gradient(top, #efefef 0%, #bbbbbb 100%);  
    background: -moz-linear-gradient(top, #efefef 0%, #bbbbbb 100%); 
    background: -webkit-linear-gradient(top, #efefef 0%,#bbbbbb 100%); 
    box-shadow: 0px 0px 9px rgba(0,0,0,0.15);
    padding: 0 20px;
    border-radius: 10px;  
    list-style: none;
    position: relative;
    display: inline-table;
}
    nav ul:after {
        content: ""; clear: both; display: block;
    }
 
    nav ul li {
        float: left;
    }
        nav ul li:hover {
            background: #4b545f;
            background: linear-gradient(top, #4f5964 0%, #5f6975 40%);
            background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 40%);
            background: -webkit-linear-gradient(top, #4f5964 0%,#5f6975 40%);
        }
            nav ul li:hover a {
                color: #fff;
            }
         
        nav ul li a {
            display: block; padding: 25px 40px;
            color: #757575; text-decoration: none;
        }
             
         
    nav ul ul {
        background: #5f6975; border-radius: 0px; padding: 0;
        position: absolute; top: 100%;
    }
        nav ul ul li {
            float: none; 
            border-top: 1px solid #6b727c;
            border-bottom: 1px solid #575f6a; position: relative;
        }
            nav ul ul li a {
                padding: 15px 40px;
                color: #fff;
            }   
                nav ul ul li a:hover {
                    background: #4b545f;
                }
         
    <!--nav ul ul ul {
        position: absolute; left: 100%; top:0;
    }-->
       

</style>
</head>
<body>
<nav>
    <ul>
        <li><a href="<?php echo "http://www.baidu.com";?>">Home</a></li>
        <li><a href="#">Tutorials</a>
            <ul>
                <li><a href="#">Photoshop</a></li>
                <li><a href="#">Illustrator</a></li>
                <li><a href="#">Web Design</a>
                    <ul>
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#">Articles</a>
            <ul>
                <li><a href="#">Web Design</a></li>
                <li><a href="#">User Experience</a></li>
            </ul>
        </li>
        <li><a href="#">Inspiration</a></li>
    </ul>
</nav>
</body>
</html>