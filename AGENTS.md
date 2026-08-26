# Workspace Guidelines: Limadia Entity Foundation Theme

## Core Development Rules

1. **Primary Development Workspace**:
   - **Active Theme Folder**: `limadia-entity-foundation-v1` (`/Users/realjblaq/Local Sites/limadia-entity-foundation/app/public/wp-content/themes/limadia-entity-foundation-v1`)
   - This directory contains the active WordPress theme running on the local WordPress development environment.
   - All code implementation, template editing, WordPress hooks/functions, assets, and styling for the website must happen inside this directory.

2. **UI/UX Reference Workspace**:
   - **HTML Reference Folder**: `charityfund-client-html` (`/Users/realjblaq/Desktop/themes/charityfund-client-files-v3.4/charityfund-client-html`)
   - This folder serves purely as an HTML/CSS/JS/UI/UX design reference template.
   - **DO NOT** make permanent production edits in or commit changes from the `charityfund-client-html` folder.

3. **Git & Deployment Rules**:
   - Only commit and push changes originating from the WordPress theme folder (`limadia-entity-foundation-v1`).
   - Never push changes from the `charityfund-client-html` reference folder.
