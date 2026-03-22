//body fat percentage
document.getElementById("bodyfat").addEventListener("submit", function (e) {

    e.preventDefault(); // stop page refresh

    // get values
    let gender = document.querySelector('input[name="gender"]:checked').value;
    //let age = document.getElementById("Age").value;
    let hip = parseFloat(document.getElementById("Hip").value);
    let height = parseFloat(document.getElementById("Height").value);
    let neck = parseFloat(document.getElementById("Neck").value);
    let waist = parseFloat(document.getElementById("Waist").value);



    let bodyfat;

    if (gender === "male") {
        height = height / 2.54;
        neck = neck / 2.54;
        waist = waist / 2.54;
        bodyfat = 86.010 * Math.log10(waist - neck) - 70.041 * Math.log10(height) + 36.76;
    }
    if (gender === "female") {
        height = height / 2.54;
        neck = neck / 2.54;
        waist = waist / 2.54;
        hip = hip / 2.54;
        bodyfat = 163.205 * Math.log10(waist + hip - neck) - 97.684 * Math.log10(height) - 78.387;
    }

    bodyfat = bodyfat.toFixed(2);
    let category = getCategory(bodyfat , gender);
    document.getElementById("result").innerText = "Estimated Body Fat: " + bodyfat + "%" + " " + category;

});
//BMI
document.getElementById("BMI").addEventListener("submit",function (e) {
    e.preventDefault();
    let height = parseFloat(document.getElementById("Height2").value); 
    let weight = parseFloat(document.getElementById("Weight2").value);
    let meter = height / 100 ;
    let BMI = weight / (meter * meter) ;
    let category = getBMICategory(BMI);
    document.getElementById("result2").innerText = "Estimated BMI: " + BMI.toFixed(2) + " " + category;

});
//whr
document.getElementById("WHR").addEventListener("submit",function (e){
    e.preventDefault();
    let Gender = document.querySelector('input[name = "gender"]:checked').value;
    let Waist = parseFloat(document.getElementById("Waist2").value); 
    let Hip = parseFloat(document.getElementById("Hip2").value);
    let WHR = Waist / Hip ;
    let category = getWHRCategory(WHR,Gender);
    document.getElementById("result3").innerText = "Estimated WHR: " + WHR.toFixed(2) + " " + category;

});
//whr
function getWHRCategory(WHR , gender){
    if (gender === "Male"){
        if (WHR <= 0.90){
            return "Low Risk";
        }
        else if (WHR <= 0.99){
            return "Moderate Risk";
        }
        else if (WHR >= 1.0){
            return "High Risk";
        }
    }
    else if(gender === "Female"){
        if (WHR <= 0.80){
            return "Low Risk";
        }
        else if (WHR <= 0.85){
            return "Moderate Risk";
        }
        else if (WHR >= 0.86){
            return "High Risk";
        }
    }
}
//bmi
function getBMICategory(BMI){
    if (BMI < 18.5){
        return "Underweight";
    }
    else if(BMI < 24.9){
        return "Normal Weight";
    }
    else if (BMI < 29.9){
        return "Overweight";
    }
    else if (BMI < 34.9){
        return "Obesity Class I";
    }
    else if (BMI < 39.9){
        return "Obesity Class II";
    }
    else {
        return "Obesity class III (Severe obesity)"
    }
}
//body fat
function getCategory(bodyFat, gender) {
    if (gender === "male") {
        if (bodyFat < 6) {
            return "Essential fat";
        }
        else if (bodyFat >= 6 && bodyFat <= 13) {
            return "Athletic";
        }
        else if (bodyFat >= 14 && bodyFat <= 17) {
            return "Fitness";
        }
        else if (bodyFat >= 18 && bodyFat <= 24) {
            return "Average";
        }
        else {
            return "Obese";
        }
    }
    if (gender === "female") {
        if (bodyFat < 14) {
            return "Essential fat";
        }
        else if (bodyFat >= 14 && bodyFat <= 20) {
            return "Athletic";
        }
        else if (bodyFat >= 21 && bodyFat <= 24) {
            return "Fitness";
        }
        else if (bodyFat >= 25 && bodyFat <= 31) {
            return "Average";
        }
        else {
            return "Obese";
        }
    }
}