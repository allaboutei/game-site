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
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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
            font-size: 1em;
            color: #555;
        }

        /* Experience Section */
        .experience {
            background: #fff;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
.experience h2{
    color: #2575fc;
}
        .experience:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Timeline Layout */
        .timeline {
            position: relative;
            padding-left: 20px;
           
        }

        .timeline-item {
            position: relative;
            padding: 20px 0;
            margin-left: 20px;
        }

        .timeline-icon {
            position: absolute;
            left: -35px;
            top: 46%;
            width: 25px;
            height: 25px;
            font-size: 18px;
        }

        .timeline-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-left: 4px solid #2575fc;
        }

        .timeline-content:hover {
            transform: scale(1.03);
        }

        .timeline-content h3 {
            margin-bottom: 8px;
            color: #2575fc;
           
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
            overflow: hidden;
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

   
        .wh100{
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
            height: 80%;
        }
   @media screen and (max-width:600px) {
    .wh100{
         
            width: 100%;
            height: 100%;
        }
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
            <p style="text-indent: 10%;">Hello! I'm Khant Si Thu, a tech enthusiast with a deep interest in computer systems, digital logic, and problem-solving. While I have a strong passion for coding and software development, I also have hands-on experience in IT support, including hardware installation, troubleshooting, and network maintenance. With over three years of experience in web development and nearly a year working as an IT Support Technician, I have developed a well-rounded technical skill set. My expertise includes system diagnostics, software troubleshooting, and managing IT infrastructures. I am eager to apply my skills in a dynamic work environment while continuously learning and growing in the field.</p>
        </section>

        <!-- Experience Section -->
        <section class="experience">
            <h2>Working Experiences</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon">💻</div>
                    <div class="timeline-content">
                        <h3>IT Support Technician and Stock keeping</h3>
                        <p><strong>Company : </strong>Super Electronics Company Ltd</p>
                        <p><strong>Duration : </strong> April 2022 - March 2023</p>
                        <p>Provided technical support, hardware troubleshooting, and network maintenance</p>
                        <p>Order tracking, record keeping and reporting</p>

                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon">🌐</div>
                    <div class="timeline-content">
                        <h3>Web Developer (Freelance)</h3>
                        <p><strong>Company:</strong> Strategy First International College</p>
                        <p><strong>Duration:</strong> 2024 - Present</p>
                        <p>Developed and maintained websites, optimized performance, and implemented database solutions.</p>
                    </div>
                </div>
            </div>
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
                        <?php if (isset($row['hostinglink'])) {
                        ?>
                            <p>Hosted at : <a style="color: #2575fc; " href="<?php echo $row['hostinglink']; ?>" target="_blank"><?php echo $row['hostinglink']; ?></a></p>
                        <?php
                        } else {
                        ?>
                            <p>Github Link : <a style="color: #2575fc;" href="<?php echo $row['gitlink']; ?>" target="_blank"><?php echo $row['gitlink']; ?></a></p>
                        <?php
                        }
                        ?>
                    </div>
            <?php
                }
            }
            ?>


        </section>

        <section class="projects">
        <h2>Education Documents</h2>
        <div class="project">
            <h3>Level 4 Diploma In Computing by NCC Education, UK</h3>
            <img class="wh100" src="images/Profesional qualification NCC level 4.jpg" alt="">
        </div>
        <div class="project">
            <h3>Level 5 Diploma In Computing by NCC Education, UK (Awaiting certificate)</h3>
            <p>The following document is dedicated to completion of the semisters</p>
            <img class="wh100" src="images/L5 First Semister.jpg" alt="NCC L5 First Semister">
        </div>
        <div class="project">
            <h3>Letter of Recommendation</h3>
            <img class="wh100" src="images/LoR.jpg" alt="">
        </div>
            </section>

        <section class="contact">
            <h2>Contact Information</h2>
            <p>Email : <a href="mailto:khantsithu.phoenix.kst@gmail.com">khantsithu.phoenix.kst@gmail.com</a></p>
            <p>Phone No :<a href="callto:89105832">+65 89105832</a> </p>
            <p>Address : Choa Chu Kang, Ave-3</p>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Khant Si Thu. All rights reserved.</p>
    </footer>

</body>

</html>