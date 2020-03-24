<?php
session_start();
include "functions/userGet.php";

/* Check loginned session */
if(!isset($_SESSION['user_id'])) {
	Header("Location: ./index.php");
}
?>


<!-- View -->
<html>
<head>
	<meta charset="utf-8"/>
	<title>우리집 사진첩 - 메인</title>
	<style type="text/css">
            body {
                font-size: 0.8em;
                font-family: dotum;
                line-height: 1.6em;
            }
            header {
                border-bottom: 1px solid #ccc;
                padding: 20px 0;
            }
            nav {
                float: left;
                margin-right: 20px;
                min-height: 1000px;
                min-width:150px;
                border-right: 1px solid #ccc;
            }
            nav ul {
                list-style: none;
                padding-left: 0;
                padding-right: 20px;
            }
            article {
                float: left;
            }
            a.no-uline {
            	text-decoration: none
            }
            .description{
                width:500px;
            }
        </style>
</head>

<body id="body">
	<div>
		<nav>
			<!-- album Menu -->
			<ul>
				<button onclick="location.href='./modify.php?mod=albumCreate'">앨범 만들기</button>
			</ul>
			<!-- album List -->
			<ul>
				<?php
                $albumNames = get_User_albumAssoc($_SESSION['user_id']);
                if(is_null($albumNames) === false) {
                    foreach($albumNames as $i) {
                        $i = htmlspecialchars($i['album_name']);
                        echo "<li><a href=\"?album={$i}\" class=\"no-uline\">{$i}</a></li>";    
                    }
                }
				?>
			</ul>
		</nav>
		<article>
			<!-- album Images -->
			<ul>

			</ul>
		</article>
	</div>
</body>
</html>