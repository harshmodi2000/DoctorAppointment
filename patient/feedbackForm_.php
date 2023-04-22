<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
</head>
<body>

    <form action="#" method="post">

        <h3>Common Symptoms</h3>

        <p>Researchers in China found that the most common symptoms among people who were hospitalized with COVID-19 include:</p>

        <input type="checkbox" name="common_symptoms_list[]" value="Fever"><label>Fever</label><br />

        <input type="checkbox" name="common_symptoms_list[]" value="Fatigue"><label>Fatigue</label><br />

        <input type="checkbox" name="common_symptoms_list[]" value="A dry cough"><label>A dry cough</label><br />

        <input type="checkbox" name="common_symptoms_list[]" value="Loss of appetite"><label>Loss of appetite</label><br />

        <input type="checkbox" name="common_symptoms_list[]" value="Body aches"><label>Body aches</label><br />

        <input type="checkbox" name="common_symptoms_list[]" value="Shortness of breath"><label>Shortness of breath</label><br />

        <input type="checkbox" name="common_symptoms_list[]" value="Mucus or phlegm"><label>Mucus or phlegm</label><br />

        <strong>TIP*:</strong>

        <p>Symptoms usually begin 2 to 14 days after you come into contact with the virus.</p>



        <h3>Other symptoms may include:</h3>

        <input type="checkbox" name="other_symptoms_list[]" value="Sore throat"><label>Sore throat</label><br />

        <input type="checkbox" name="other_symptoms_list[]" value="Headache"><label>Headache</label><br />

        <input type="checkbox" name="other_symptoms_list[]" value="Chills, sometimes with shaking"><label>Chills, sometimes with shaking</label><br />

        <input type="checkbox" name="other_symptoms_list[]" value="Loss of smell or taste"><label>Loss of smell or taste</label><br />

        <input type="checkbox" name="other_symptoms_list[]" value="Congestion or runny nose"><label>Congestion or runny nose</label><br />

        <input type="checkbox" name="other_symptoms_list[]" value="Nausea or vomiting"><label>Nausea or vomiting</label><br />

        <input type="checkbox" name="other_symptoms_list[]" value="Diarrhea"><label>Diarrhea</label><br />



        <h3>Emergency Symptoms</h3>

        <p>Call a doctor or hospital right away if you have one or more of these COVID-19 symptoms:</p>

        <input type="checkbox" name="e_symptoms_list[]" value="Trouble breathing"><label>Trouble breathing</label><br />

        <input type="checkbox" name="e_symptoms_list[]" value="Constant pain or pressure in your chest"><label>Constant pain or pressure in your chest</label><br />

        <input type="checkbox" name="e_symptoms_list[]" value="Bluish lips or face"><label>Bluish lips or face</label><br />

        <input type="checkbox" name="e_symptoms_list[]" value="Sudden confusion"><label>Sudden confusion</label><br />











        <input type="submit" name="submit" value="Submit" />





        <?php

        if (isset($_POST['submit'])) {

            if (!empty($_POST['common_symptoms_list'])) {

                foreach ($_POST['common_symptoms_list'] as $selected) {

                    echo $selected . "</br>";

                }

            }

            if (!empty($_POST['other_symptoms_list'])) {

                foreach ($_POST['other_symptoms_list'] as $selected) {

                    echo $selected . "</br>";

                }

            }

            if (!empty($_POST['e_symptoms_list'])) {

                foreach ($_POST['e_symptoms_list'] as $selected) {

                    echo $selected . "</br>";

                }

            }

        }

        ?>

    </form>

</body>



</html>