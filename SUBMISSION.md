Total time spent: 3h 20m

Approach:
- Add Post model and unique(source,external_id) to prevent duplicates
- Add ImporterInterface and two importers (jsonplaceholder, fakestore)
- Add config/importers.php registry and import:random artisan command
- Admin UI to trigger single-import execution (saves as draft)
- Tests using Http::fake()

How to add a new source:
1. Create a class implementing ImporterInterface in app/Services/Importers
2. Add the class to config/importers.php with a new key
3. (Optional) add tests using Http::fake()

Improvements:
- Move import to queued jobs, add retries/backoff and metrics
- Add preview in admin before saving
- Sanitize HTML in imported content
- Add importer factory for DI and dynamic registration
