# Root file directory of the web project

project/
│
├── assets/                   # Contains static assets
│   ├── bootstrap/            # Bootstrap framework files
│   ├── css/                  # CSS files
│   ├── fonts/                # Font files
│   ├── icons/                # Icon files
│   └── images/               # Image files
│
├── classes/                  # for php classes
|
├── utils/                   # for store reusable functions, etc..
|
├── components/               # Reusable HTML components
│   ├── navbar.html           # Navigation bar component
│   ├── footer.html           # Footer component
│   ├── modals.html           # Modal dialogs component
│   └── cards.html            # Card components
│
├── layouts/                  # Layout templates
│   ├── main-layout.html      # Main layout template
│   └── sidebar-layout.html   # Sidebar layout template
│
├── pages/                    # Individual web pages
│   ├── index.html            # Home page
│   ├── about.html            # About page
│   └── contact.html          # Contact page
│
├── admin/                    # Admin panel files
│   ├── assets/               # Admin static assets
│   │   ├── css/              # Admin CSS files
│   │   ├── images/           # Admin image files
│   │   └── js/               # Admin JavaScript files
│   ├── components/           # Admin reusable components
│   │   ├── sidebar.html      # Admin sidebar component
│   │   └── admin-navbar.html # Admin navigation bar component
│   ├── layouts/              # Admin layout templates
│   │   └── admin-layout.html # Admin layout template
│   ├── pages/                # Admin individual pages
│   │   ├── dashboard.html    # Admin dashboard page
│   │   ├── users.html        # Admin users management page
│   │   └── settings.html     # Admin settings page
│   └── utils/                # Admin utility scripts
│       └── admin-scripts.js  # Admin JavaScript utility functions
│
├── data/                     # Data files
│   └── data.json             # JSON data file
│
├── public/                   # Publicly accessible files
│   ├── favicon.ico           # Favicon file
│   ├── robots.txt            # Robots.txt file
│   └── manifest.json         # Web app manifest file
│
└── index.html                # Main entry point HTML file


## *Reference*
[*dev.to - Obaseki Noruwa - Folder Structure for Modern Web Applications*](https://dev.to/noruwa/folder-structure-for-modern-web-applications-4d11)