// constants, globals
const API_BASE = "api/";
const IMG_BASE = "https://cdn.babycenter.si/products/250x250";

const sortPriceSelector = document.getElementById("sortPrice");
const container = document.getElementById("articlesContainer");

const loadingGIF = "public/loading.gif";

let articlesArr = [];

// utilities
const priceFormatter = new Intl.NumberFormat('de-DE', {
    style: 'currency',
    currency: 'EUR',
    trailingZeroDisplay: 'stripIfInteger'
});

function formatPrice(price) {
    return priceFormatter.format(price);
}

function createElement(tag, className = "", text = "") {
    const el = document.createElement(tag);
    if (className) el.className = className;
    if (text) el.textContent = text;
    return el;
}

// render functions
function renderArticlesFromArray() {
    container.innerHTML = "";

    if (articlesArr.length == 0) {
        renderError("Ni zaloge.");
        return;
    }

    articlesArr.forEach(article => {
        const articleEl = createElement("div", "article");

        const imgSrc = article.images?.[0]?.imageAddress ? IMG_BASE + article.images[0].imageAddress : loadingGIF;

        const img = createElement("img");
        img.src = imgSrc;
        img.alt = article.name;
        img.width = 250;
        img.height = 250;

        const name = createElement("span", "", article.name);
        const price = createElement("span", "", formatPrice(article.price));

        const stock = createElement("span", "");
        stock.style.color = article.stock != 0 ? "green" : "red";
        stock.textContent = article.stock != 0 ? "Na zalogi" : "Trenutno ni na zalogi";

        articleEl.append(img, name, stock, price);
        container.appendChild(articleEl);
    });
}

function loadingElement() {
    const wrapper = createElement("div", "loadingElementWrapper");
    const loader = createElement("div", "loadingElement");

    const img = createElement("img");
    img.src = loadingGIF;
    img.alt = "Loading gif";
    img.width = 50;
    img.height = 50;

    const text = createElement("span", "", "Loading...");

    loader.append(img, text);
    wrapper.appendChild(loader);

    return wrapper;
}

function renderError(message) {
    container.innerHTML = "";
    const errorEl = createElement("div", "errorMessage", message);
    container.appendChild(errorEl);
}

// fetch functions
async function fetchArticlesAsObjects(sortParam = "") {
    try {
        const response = await fetch(API_BASE + sortParam);
        if (!response.ok) throw new Error("Network response was not ok");

        const rawData = await response.json();

        articlesArr = Object.values(rawData).map(a => ({
            name: a.name ?? "",
            price: a.price ?? 0,
            images: a.gallery?.map(img => ({ imageAddress: img.imageUrl })) ?? [],
            stock: a.stock ?? 0
        }));

        renderArticlesFromArray();
    } catch (err) {
        console.error("Failed to load articles:", err);
        renderError("Napaka pri nalaganju artiklov.");
    }
}

async function loadArticles(sortParam = "") {
    container.replaceChildren(loadingElement());
    await fetchArticlesAsObjects(sortParam);
}

// event binding
function selectSortPrice() {
    const params = new URLSearchParams();
    if (sortPriceSelector.value === "default") {
        loadArticles("");
        return;
    }
    params.set("sortPrice", sortPriceSelector.value);
    loadArticles("?" + params.toString());
}

function bindEvents() {
    sortPriceSelector.addEventListener("change", selectSortPrice);
}

// initial load
bindEvents();
loadArticles("");