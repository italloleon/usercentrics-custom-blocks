document.addEventListener("DOMContentLoaded", function () {
    const ldJsonScript = document.getElementById("usercentrics-custom-blocks-ld-json");
    const faqItems = document.querySelectorAll(".uc-faq-item");
    if (ldJsonScript && faqItems.length > 0) {
        let faqSchema = { 
            "@context": "https://schema.org",
            "@type": "FAQPage",
            mainEntity: []
        };

        faqItems.forEach(faqItem => {
            const faqItemTitle = faqItem.querySelector('[itemprop="name"]');
            const faqItemTitleText = faqItemTitle ? faqItemTitle.textContent.trim() : '';
            const faqItemContent = faqItem.querySelector('[itemprop="acceptedAnswer"]');
            const faqItemContentText = faqItemContent ? faqItemContent.textContent.trim() : '';

            faqSchema.mainEntity.push({
                "@type": "Question",
                name: faqItemTitleText,
                acceptedAnswer: {
                    "@type": "Answer",
                    text: faqItemContentText
                }
            })
        })
        ldJsonScript.textContent = JSON.stringify(faqSchema);
    }
});