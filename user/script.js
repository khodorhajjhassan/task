let addDegree = document.getElementById("addDegree");
let edit = document.getElementById("edit");
let addInput = document.getElementById("addInput");

addInput.innerHTML="";

addDegree.addEventListener("click",function(){

    addInput.innerHTML = `  <form action="addDegree.php" method="POST" enctype="multipart/form-data">

    <div class="row mt-5">
        <div class="col-md-3 col-sm-6 mb-2">
            <select required name="certeficate" class="form-control" id="typeOf">
                <option value="" selected disabled>Type of degree</option>
                <option value="1">Bachelor degre</option>
                <option value="2">Master degree</option>
                <option value="3">Phd</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-6 mb-2">
            <input required type="text" placeholder="name of degree" class="form-control" id="nameOf" name="degreename">
    </div>
   

    
    <div class="col-md-3 col-sm-6 mb-2">
        <button type="submit" class="btn btn-warning text-white">Submit</button>
</div>
</div>
</form>`



})

edit.addEventListener("click",function(){

    addInput.innerHTML = `  <form id="updateForm" action="updateUser.php" method="POST">
    <div class="row mt-5">
        <div class="col-md-3 col-sm-6 mb-2">
        <input type="text" placeholder="Enter your name" class="form-control" id="nameOf" name="name">

        </div>
        <div class="col-md-3 col-sm-6 mb-2">
        <select name="blood_type" class="form-control"  id="">
        <option value="" selected disabled>Blood type</option>
        <option value="A+">A+</option>
        <option value="B+">B+</option>
        <option value="A-">A-</option>
        <option value="B-">B-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
    </select>
    </div>
    <div class="col-md-3 col-sm-6 mb-2">
    <select name="gender"  class="form-control" id="">
    <option value="" selected disabled>Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
</select>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <button  type="submit" class="btn btn-warning text-white">Submit</button>
</div>
</div>
</form>`

})

let err=document.getElementById("err");
      setTimeout(function() {
        document.getElementById("err").style.display = "none";
      }, 2000);

      document.getElementById("showDegree").addEventListener("click", function () {
        var xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    document.getElementById("showInput").innerHTML = response;
                } else {
                    document.getElementById("showInput").innerHTML = "Error: " + xhr.status;
                }
            }
        };
        
        xhr.open("GET", "showDegree.php", true);
        xhr.send();
    });


    let updateForm = document.getElementById("updateForm");
updateForm.addEventListener("submit", function (event) {

    var formData = new FormData(updateForm);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                alert(xhr.responseText);
            } else {
                alert("Error: " + xhr.statusText);
            }
        }
    };

    xhr.open("POST", "updateUser.php", true);
    xhr.send(formData);
});

    function removeCertificate(certificateId) {
        if (confirm("Are you sure you want to remove this certificate?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        alert("Certificate removed successfully.");
                        location.reload();
                    } else {
                        alert("Error: " + xhr.statusText);
                    }
                }
            };
            
            xhr.open("POST", "deleteDegree.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("certificateId=" + certificateId);
        }
    }