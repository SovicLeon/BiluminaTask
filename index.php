<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table id="itemsContainer">
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </table>
</body>

</html>

<script>
    /*function getAds() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("itemsContainer").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "http://localhost/biluminatask/api/", true);
        xmlhttp.send();
    }*/

    //getAds();

    loadAds();

    async function loadAds() {
        try {
            const response = await fetch("api/");
            const ads = await response.text();
            renderAds(ads);
        } catch (err) {
            console.error("Failed to load ads:", err);
        }
    }

    function renderAds(ads) {
        const obj = JSON.parse(ads);

        console.log(obj);

        for (const ad of Object.values(obj)) {
            const row = document.createElement("tr");
            row.id = ad.id;

            row.innerHTML = "<td>" + ad.name + "</td>";
            row.innerHTML += "<td>" + ad.price + "</td>";

            document.getElementById("itemsContainer").appendChild(row);
        }
    }
</script>