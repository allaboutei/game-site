<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once("config/regdbconnect.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <style>
        

        /* General Styles */
        body {
            font-family: 'Century Gothic', sans-serif;
            margin: 0 auto;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.5;
        }

        h1,
        h2,
        h3 {
            font-weight: 600;
            margin: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

       /* Header */
       header {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
        padding: 20px 0px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-in-out;
        }

        header h1 {
            font-size: 3em;
            margin-bottom: 10px;
            animation: fadeInDown 1s ease-in-out;
        }

        header p {
            font-size: 1.2em;
            opacity: 0.9;
            animation: fadeInUp 1s ease-in-out;
        }
        /* Container */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        /* Sections */
        .about,
        .projects,
        .contact {
            background: #fff;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .about:hover,
        .projects:hover,
        .contact:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .about h2,
        .projects h2,
        .contact h2 {
            font-size: 2em;
            color: #2575fc;
            margin-bottom: 20px;
        }

        .about p {
            font-size: 1.1em;
            color: #555;
        }

        /* Projects Section */
        .projects .project {
            margin-bottom: 25px;
            padding: 20px;
            border-left: 4px solid #2575fc;
            background: #f8f9fa;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .projects .project:hover {
            transform: translateX(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .projects .project h3 {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 10px;
        }

        .projects .project p {
            font-size: 1em;
            color: #666;
        }

        /* Contact Section */
        .contact a {
            color: #2575fc;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .contact a:hover {
            color: #6a11cb;
        }

        /* Footer */
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 60px;
        }

        footer p {
            margin: 0;
            font-size: 0.9em;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

<header>
        <img src="images/Profile_pic.jpg" alt="Profile Image" class="profile-image">
        <h1>Khant Si Thu</h1>
        <p>Web Developer & IT Support Techanician</p>
    </header>
   
    
    <div class="container">
        <section class="about">
            <h2>About Me</h2>
            <p style="text-indent: 10%;">Hello! I'm Khant Si Thu, a person who is very fond of computer systems, digital logics and eager to learn fresh knowledge and collecting experiences related to programming, installation and troubleshooting of computer hardware and software. With over 2 years of experience in web development and almost a year in IT support techanician. I have a hobby in website development and database management systems.</p>
        </section>

        <section class="projects">
            <h2>Projects</h2>
            <?php
            $sql = "SELECT * FROM tbl_project";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="project">
                        <h3>Project <?php echo $row['id'] ?>: <?php echo $row['name'] ?></h3>
                        <p><?php echo $row['description'] ?></p>
                        <?php if(isset($row['hostinglink'])){
?>
<p>Hosted at : <a style="color: #2575fc;" href="<?php echo $row['hostinglink']; ?>"><?php echo $row['hostinglink']; ?></a></p>
<?php
                        } 
                     else{
?>
<p>Github Link : <a style="color: #2575fc;" href="<?php echo $row['gitlink']; ?>"><?php echo $row['gitlink']; ?></a></p>
<?php
                     }   
                        ?>
                    </div>
            <?php
                }
            }
            ?>


        </section>

        <section class="contact">
            <h2>Contact Iformation</h2>
            <p>Email : <a href="mailto:john.doe@example.com">khantsithu.phoenix.kst@gmail.com</a>.</p>
            <p>Phone No : +65 89105832</p>
        </section>
    </div>

    <footer>
        <p>&copy; 2023 Khant Si Thu. All rights reserved.</p>
    </footer>

</body>

</html>