Laravel application with list of professions where logged in candidates can apply for each profession, 
optionally finish the exam of questions and see the results, 
guest is restricted only to see professions and locations list, 
while admin user has complete control over data - CRUD operations for users. candidates. professions, questions and locations. 

This project contains database seeding, 
custom login and registration forms, 
routes that are secured by middlewares or policies for authorization inside controllers as well as inside blade templates. 

Local and global scopes,
soft-deleting,  
view composer with redis caching, 
various model relations and model observer classes. 

Email sending happens as background queued job with markdown blade style, 
including event with listener for multiple email sending.

File upload also included for CV .pdf files and it is also included as a link inside mail,
validation present on every form, 
counter for current users on a page is used for professions and locations as custom facade.

Bootstrap is included to style every page.

