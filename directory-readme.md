# Root file directory of the web project

	project/
	│
	├── assets/                   # Shared assets
	│   ├── bootstrap/            # Shared bootsrap framework's files
	│   ├── css/                  # Shared CSS files
	│   ├── fonts/                # Shared font files
	│   ├── icons/                # Shared icon files
	│   └── images/               # Shared images
	│
	├── components/               # Shared UI components
	│   ├── navbar.html           # Navbar code
	│   ├── footer.html           # Footer code
	│   ├── modals.html           # Modals
	│   └── cards.html            # Card UI components
	│
	├── layouts/                  # Shared layouts
	│   ├── main-layout.html      # General layout
	│   └── sidebar-layout.html   # Sidebar-specific layout
	│
	├── pages/                    # Public-facing pages
	│   ├── index.html            # Homepage
	│   ├── about.html            # About page
	│   └── contact.html          # Contact page
	│
	├── admin/                    # Admin-specific files
	│   ├── assets/               # Admin-specific assets
	│   │   ├── css/              # Custom admin CSS files
	│   │   ├── images/           # Admin-specific images
	│   │   └── js/               # Admin-specific JavaScript files
	│   ├── components/           # Admin-specific components
	│   │   ├── sidebar.html      # Sidebar for admin
	│   │   └── admin-navbar.html # Navbar for admin
	│   ├── layouts/              # Admin layouts
	│   │   └── admin-layout.html # General admin layout
	│   ├── pages/                # Admin pages
	│   │   ├── dashboard.html    # Admin dashboard
	│   │   ├── users.html        # Manage users
	│   │   └── settings.html     # Admin settings
	│   └── utils/                # Admin utility scripts
	│       └── admin-scripts.js  # Custom admin JavaScript
	│
	├── data/                     # Shared JSON data
	│   └── data.json             # Shared JSON files for both sites
	│
	├── public/                   # Publicly accessible files
	│   ├── favicon.ico           # Favicon
	│   ├── robots.txt            # Robots.txt for SEO
	│   └── manifest.json         # Web app manifest file
	│
	└── index.html                # Root HTML file for main site

## *Reference*
[*dev.to - Obaseki Noruwa - Folder Structure for Modern Web Applications*](https://dev.to/noruwa/folder-structure-for-modern-web-applications-4d11)