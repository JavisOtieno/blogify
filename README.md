# Nex Digital / Goodcommerce

## Fullstack Developer Test

### Blog Platform with Content Importer

---

## **Objective**

Build a simple blog platform that can import content from external APIs.  
Show us your approach to API integration and data transformation.

## **Time Estimate**

This task should not take more than 4 hours.

---

## **Requirements**

### **Blog Features**

- Blog posts with: `title`, `content`, `status` (draft/published), `source`, `external_id`
- Admin panel to manage posts
- Public page to view published posts

### **Import Functionality**

- Import from **JSONPlaceholder API** — random blog post
- Import from **FakeStore API** — random product (transform to blog post)
- Single item import per execution
- Duplicate prevention
- Imported posts saved as drafts

### **APIs**

- **JSONPlaceholder**: `https://jsonplaceholder.typicode.com/posts/{randomId}`
- **FakeStore API**: `https://fakestoreapi.com/products/{randomId}`

---

## **The Challenge**

Transform two different data structures into consistent blog posts.

### **JSONPlaceholder Post Example**

```json
{
  "id": 1,
  "title": "blog post title", 
  "body": "blog post content"
}
```

### **FakeStore Product Example**

```json
{
  "id": 1,
  "title": "Product Name",
  "description": "Product description",
  "price": 109.95,
  "category": "product category"
}
```

Both should be transformed into blog posts in your system.

---

## **Setup**

```bash
git clone [repository]
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## **Submission**

## Submission Instructions

1. Use this repository template
2. Build your solution
3. Commit with meaningful messages
4. Submit your repository URL for us to review
5. Include in your submission:
    - Total time spent
    - Explain your approach
    - Explain how you would add a new API Source
    - Propose improvement to your own code

---

## **Evaluation Focus**

- Problem-solving approach
- Code quality and structure
- User experience
- Commit history

Show us how you think.

---

## **Closing Note**

We look forward to reviewing your solution and seeing how you approach real-world API integration challenges.
# blogify
