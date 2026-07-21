# Blade Components

Laravel 13 Starter Template provides a collection of reusable Blade components to keep the UI consistent and reduce duplicated markup.

---

# Overview

Components are organized by responsibility.

```
resources/views/components
│
├── badges
├── branding
├── buttons
├── crud
├── dashboard
├── feedback
├── forms
├── layout
├── modals
└── navigation
```

Every component follows Laravel's native Blade Component system.

Example:

```blade
<x-buttons.primary>
    Save
</x-buttons.primary>
```

---

# Buttons

Location

```
resources/views/components/buttons
```

Available components

```
primary
secondary
danger
danger-button
```

Example

```blade
<x-buttons.primary>
    Save
</x-buttons.primary>

<x-buttons.secondary>
    Cancel
</x-buttons.secondary>

<x-buttons.danger>
    Delete
</x-buttons.danger>
```

Features

* Loading state
* Disabled state
* Consistent styling
* Alpine.js support

---

# Forms

Location

```
resources/views/components/forms
```

Available components

```
field
input-label
text-input
textarea
select
```

Example

```blade
<x-forms.field
    label="Full Name"
    for="name"
    :error="$errors->get('name')"
>
    <x-forms.text-input
        id="name"
        name="name"
        class="w-full"
    />
</x-forms.field>
```

Benefits

* Validation support
* Consistent spacing
* Standardized labels
* Reusable layout

---

# CRUD Components

Location

```
resources/views/components/crud
```

Available components

```
page
form-page
toolbar
table-card
form-card
form-actions
```

Example

```blade
<x-crud.page
    title="Users"
    description="Manage application users."
>

    <x-slot:actions>

        <x-buttons.primary>
            Add User
        </x-buttons.primary>

    </x-slot:actions>

    <x-crud.toolbar>

        ...

    </x-crud.toolbar>

    <x-crud.table-card>

        ...

    </x-crud.table-card>

</x-crud.page>
```

Purpose

* Standard page layout
* Consistent spacing
* Better maintainability

---

# Dashboard Components

Location

```
resources/views/components/dashboard
```

Available components

```
stat-card
panel
action-link
```

Stat Card

```blade
<x-dashboard.stat-card
    title="Users"
    value="52"
/>
```

Panel

```blade
<x-dashboard.panel
    title="Recent Activity"
>

    ...

</x-dashboard.panel>
```

Action Link

```blade
<x-dashboard.action-link
    href="#"
>

    View Users

</x-dashboard.action-link>
```

---

# Badge Components

Location

```
resources/views/components/badges
```

Available

```
primary
success
warning
danger
info
```

Example

```blade
<x-badges.success>
    Active
</x-badges.success>

<x-badges.warning>
    Pending
</x-badges.warning>

<x-badges.danger>
    Deleted
</x-badges.danger>
```

---

# Feedback Components

Location

```
resources/views/components/feedback
```

Available

```
toast
input-error
auth-session-status
```

Toast

```blade
<x-feedback.toast />
```

Input Error

```blade
<x-feedback.input-error
    :messages="$errors->get('email')"
/>
```

Session Status

```blade
<x-feedback.auth-session-status
    :status="session('status')"
/>
```

---

# Modal Components

Location

```
resources/views/components/modals
```

Available

```
modal
confirm-modal
```

Example

```blade
<x-modals.confirm-modal
    name="delete-user"
    title="Delete User"
    message="Are you sure?"
/>
```

Features

* Focus trap
* Escape key support
* Loading state
* Reusable confirmation dialog

---

# Navigation Components

Location

```
resources/views/components/navigation
```

Available

```
dropdown
dropdown-link
nav-link
responsive-nav-link
```

Example

```blade
<x-navigation.dropdown>

    <x-slot:trigger>

        ...

    </x-slot:trigger>

    <x-slot:content>

        ...

    </x-slot:content>

</x-navigation.dropdown>
```

---

# Layout Components

Location

```
resources/views/components/layout
```

Available

```
head
scripts
card
section
```

These components provide reusable page structure shared across layouts.

---

# Branding

Location

```
resources/views/components/branding
```

Available

```
application-logo
```

Example

```blade
<x-branding.application-logo
    class="w-8 h-8"
/>
```

---

# Styling

Most components use reusable utility classes defined in

```
resources/css/app.css
```

Examples include

* btn
* badge
* form-input
* dashboard-card
* crud-page
* toast

This approach keeps Blade files clean while centralizing styling.

---

# JavaScript

Interactive components use Alpine.js.

Examples include

* Dropdown
* Sidebar
* Modal
* Toast Notification
* Button Loading State

Alpine is initialized in

```
resources/js/app.js
```

---

# Best Practices

* Prefer Blade components over repeated HTML.
* Keep styling inside reusable CSS utility classes.
* Keep business logic out of Blade components.
* Build new UI elements following the existing component structure.
* Reuse CRUD and Dashboard components whenever possible.
* Use Form components to ensure consistent validation and spacing.

Following these guidelines helps maintain a scalable and consistent user interface throughout the project.
