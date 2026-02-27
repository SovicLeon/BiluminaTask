<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <select id="sortPrice" onchange="selectSortPrice()">
        <option value="default" selected="selected">Privzeto</option>
        <option value="priceAsc">Cenejši naprej</option>
        <option value="priceDesc">Dražji naprej</option>
    </select>

    <table id="itemsContainer" border="1">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Stock</th>
        </tr>
    </table>
</body>

</html>

<script>
    // to do:
    // -sorting

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

    const sortPriceSelector = document.getElementById("sortPrice");

    let sortPrice = null;
    let sort = "";

    function selectSortPrice() {
        d = sortPriceSelector.value;
        alert(d);
        sort += "?sortPrice=" + d;
        loadAds();
    }

    const formatter = new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: 'EUR',
        trailingZeroDisplay: 'stripIfInteger'
    });

    // sort kot global var ali input par
    loadAds();

    async function loadAds() {
        try {
            const response = await fetch("api/" + sort);
            const ads = await response.text();
            renderAds(ads);
        } catch (err) {
            console.error("Failed to load ads:", err);
        }
    }

    function renderAds(ads) {
        const obj = JSON.parse(ads);

        console.log(obj);

        document.getElementById("itemsContainer").innerHTML = '<tr><th>Name</th><th>Price</th><th>Image</th><th>Stock</th></tr>';

        for (const ad of Object.values(obj)) {
            const row = document.createElement("tr");
            row.id = ad.id;

            row.innerHTML = "<td>" + ad.name + "</td>";
            row.innerHTML += "<td>" + formatter.format(ad.price) + "</td>";
            row.innerHTML += "<td><image src=\"https://cdn.babycenter.si/products/250x250" + ad.gallery[0].imageUrl + "\"/></td>";

            row.innerHTML += "<td>" + (ad.stock != 0 ? "ima" : "nema") + ad.stock + "</td>";

            document.getElementById("itemsContainer").appendChild(row);
        }
    }
</script>