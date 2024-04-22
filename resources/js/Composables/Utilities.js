export function useUtilities() {
    function formatDate(targetDate) {
        return targetDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        })
    }

    function formatTime(targetDate) {
        return targetDate.toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: 'numeric',
            hour12: true, // Include AM/PM indicator
        });
    }

    function formatAmount(number, locale = "en-US") {
        const formatter = new Intl.NumberFormat(locale, {
            style: "decimal",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        })
        return formatter.format(number)
    }

    return { formatDate, formatTime, formatAmount }
  }
