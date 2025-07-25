function fetchAndDisplayBlogs(searchQuery = "") {
  fetch("/wp-json/custom/v2/get_blogs", {
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
      const container = document.querySelector("#blogs-container");
      container.innerHTML = ""; // Clear previous results
      data.forEach((element) => {
        print_Blogs(element);
      });

      // console.log('Response from server:', data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Fetch Instructors on page load
document.addEventListener("DOMContentLoaded", function () {
  fetchAndDisplayBlogs();
});

// Fetch instructors when the form is submitted
const form = document.querySelector("#search-blogs");
form.addEventListener("submit", function (event) {
  event.preventDefault();
  const searchInput = form.querySelector('#search-blogs input[type="text"]');
  console.log(searchInput.value);
  fetchAndDisplayBlogs(searchInput.value);
  if (searchInput.value.trim() !== "") {
    document.querySelector("#blogs-container").scrollIntoView({ behavior: "smooth" });
  }
});

// Function to print products
function print_Blogs(data) {
  if (!data.readTime || data.readTime.trim() === "") {
    data.readTime = "1 minute";
  }
  const container = document.querySelector("#blogs-container");
  const article = document.createElement("article");
  article.classList.add("md:w-[32%]", "w-full");
  article.innerHTML = `
            <figure>
                <a href="${data.link}">
                    <img class="rounded-[16px] object-cover w-full h-[228px]"
                        src="${data.thumbnail}">
                </a>
            </figure>
            <div class="flex gap-2 mt-[20px]">
                <p class="text-sm font-semibold text-[#47546799]">
                    ${data.author}
                </p>
                <span
                    class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                <p class="text-sm font-semibold text-[#47546799]">
                    ${data.date}
                </p>
                 <span
                    class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                <p class="text-sm font-semibold text-[#47546799]">
                    Read Time: ${data.readTime}
                </p>
            </div>
            <div class="flex justify-between my-2">
                <a href="${data.link}">
                    <h3 class="text-rich-black text-[20px] font-semibold leading-[28px]">
                        ${data.title}</h3>
                </a>
                <a href="${data.link}"
                    class="hover:translate-x-[2px] hover:translate-y-[-2px] transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M7 17L17 7M17 7H7M17 7V17" stroke="#0B141D" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <p class="text-gray-paragraph text-[18px] mt-2">
                ${data.excerpt}
            </p>
        `;
  container.appendChild(article);
}
