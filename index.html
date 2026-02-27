<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="public/style.css">
</head>

<body>
    <nav id="navbar">
        <h1>Artikli</h1>
    </nav>
    <div class="filterWrapper">
        <div class="sortPriceWrapper">
            <label class="sortLabel" for="sortPrice">Sortiraj po ceni: </label>
            <select class="sortSelect" id="sortPrice" onchange="selectSortPrice()">
                <option value="default" selected="selected">Privzeto</option>
                <option value="priceAsc">Cenejši naprej</option>
                <option value="priceDesc">Dražji naprej</option>
            </select>
        </div>
    </div>

    <div class="articlesWrapper">
        <div class="articlesContainer" id="articlesContainer"></div>
    </div>
</body>

</html>

<script>
    // get elements
    const sortPriceSelector = document.getElementById("sortPrice");
    const container = document.getElementById("articlesContainer");

    // initial load
    loadArticles("");

    // sorting function
    function selectSortPrice() {
        const params = new URLSearchParams();
        params.set("sortPrice", sortPriceSelector.value);
        loadArticles("?" + params.toString());
    }

    async function loadArticles(sortParam = "") {
        // clear container, set loader
        container.replaceChildren(loadingElement());

        // fetch api
        try {
            const response = await fetch("api/" + sortParam);
            const articles = await response.text();
            renderArticles(articles);
        } catch (err) {
            console.error("Failed to load articles:", err);
        }
    }

    function renderArticles(articles) {
        const obj = JSON.parse(articles);

        //console.log(obj);

        // clear container
        container.innerHTML = "";

        for (const article of Object.values(obj)) {
            // base div
            const articleElement = document.createElement("div");
            articleElement.className = "article";

            // image element
            const img = document.createElement("img");
            img.src = "https://cdn.babycenter.si/products/250x250" + article.gallery[0].imageUrl;
            img.alt = article.name;
            img.width = 250;
            img.height = 250;

            // name span
            const name = document.createElement("span");
            name.textContent = article.name;

            // stock span
            const stock = document.createElement("span");
            stock.style.color = article.stock != 0 ? "green" : "red";
            stock.textContent = article.stock != 0 ? "Na zalogi" : "Trenutno ni na zalogi";

            // price span
            const price = document.createElement("span");
            price.textContent = priceFormatter.format(article.price);

            // append elements to article
            articleElement.appendChild(img);
            articleElement.appendChild(name);
            articleElement.appendChild(stock);
            articleElement.appendChild(price);

            // append article to container
            container.appendChild(articleElement);
        }
    }

    // clean up
    function loadingElement() {
        // base wrapper
        const loadingElementWrapper = document.createElement("div");
        loadingElementWrapper.className = "loadingElementWrapper";

        // base div
        const loadingElement = document.createElement("div");
        loadingElement.className = "loadingElement";

        // img element
        const img = document.createElement("img");
        img.src = "public/loading.gif";
        img.alt = "Loading gif";
        img.width = 50;
        img.height = 50;

        // name span
        const name = document.createElement("span");
        name.textContent = "Loading...";
        name.style.height = "81px";

        // append elements to article
        loadingElement.appendChild(img);
        loadingElement.appendChild(name);

        loadingElementWrapper.appendChild(loadingElement);

        // return article
        return loadingElementWrapper;
    }

    // price formatter
    const priceFormatter = new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: 'EUR',
        trailingZeroDisplay: 'stripIfInteger'
    });
</script>