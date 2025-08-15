function fetchAndDisplayInstructors(searchQuery = "") {
  fetch("/wp-json/custom/v2/get_instructors", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      search: searchQuery,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      const container = document.querySelector("#instructor-container");
      container.innerHTML = ""; // Clear previous results
      data.forEach((element) => {
        print_Instructors(element);
      });

      // console.log('Response from server:', data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Fetch Instructors on page load
document.addEventListener("DOMContentLoaded", function () {
  fetchAndDisplayInstructors();
});

// Fetch instructors when the form is submitted
const form = document.querySelector("#search-instructors");
form.addEventListener("submit", function (event) {
  event.preventDefault();
  const searchInput = form.querySelector('#search-instructors input[type="text"]');
  fetchAndDisplayInstructors(searchInput.value);
});

// Function to print products
function print_Instructors(data) {
  const container = document.querySelector("#instructor-container");
  const article = document.createElement("article");
  article.classList.add("w-full", "xl:w-[23.5%]", "lg:w-[49%]");
  article.innerHTML = `
            <figure>
                <a href="${data.link}">
                    <img loading="lazy" class="rounded-xl" src="${data.thumbnail}" alt="">
                </a>
            </figure>
            <div class="mt-[24px]">
                <h4 class="text-rich-black text-[20px] font-semibold leading-normal">
                    <a href="${data.link}" class="text-rich-black hover:underline">
                        ${data.name}
                    </a>
                </h4>
                <p class="text-gray-paragraph text-[16px] leading-normal">
                    ${data.role}
                </p>
                <a href="${data.link}" class="btn-blue mt-[24px]">Meet ${data.name} →</a>
            </div>
        `;
  container.appendChild(article);
}
