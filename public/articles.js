// constants
const API_BASE = "api/";
const IMG_BASE = "https://cdn.babycenter.si/products/250x250";

const sortPriceSelector = document.getElementById("sortPrice");
const container = document.getElementById("articlesContainer");

const loadingGIF = "public/loading.gif";

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
function renderArticles(articlesJson) {
    const obj = JSON.parse(articlesJson);
    container.innerHTML = "";

    Object.values(obj).forEach(article => {
        const articleEl = createElement("div", "article");

        const imgSrc = IMG_BASE + (article.gallery?.[0]?.imageUrl ?? loadingGIF);
        const price = formatPrice(article.price ?? 0);

        const img = createElement("img");
        img.src = imgSrc;
        img.alt = article.name;
        img.width = 250;
        img.height = 250;

        const name = createElement("span", "", article.name);

        const stock = createElement("span", "");
        stock.style.color = article.stock != 0 ? "green" : "red";
        stock.textContent = article.stock != 0 ? "Na zalogi" : "Trenutno ni na zalogi";

        const priceEl = createElement("span", "", price);

        articleEl.append(img, name, stock, priceEl);
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
async function fetchArticles(sortParam = "") {
    try {
        const response = await fetch(API_BASE + sortParam);
        if (!response.ok) throw new Error("Network response was not ok");
        const articles = await response.text();
        return articles;
    } catch (err) {
        console.error("Failed to load articles:", err);
        renderError("Napaka pri nalaganju artiklov.");
        return null;
    }
}

async function loadArticles(sortParam = "") {
    container.replaceChildren(loadingElement());
    const articles = await fetchArticles(sortParam);
    if (articles) renderArticles(articles);
}

// event binding
function selectSortPrice() {
    const params = new URLSearchParams();
    params.set("sortPrice", sortPriceSelector.value);
    loadArticles("?" + params.toString());
}

function bindEvents() {
    sortPriceSelector.addEventListener("change", selectSortPrice);
}

// initial load
bindEvents();
loadArticles("");